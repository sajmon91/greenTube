<?php 

/**
 * Processing Controller
 * Processing video, convert to mp4 and add to DB
 */
class Processing extends Controller
{
	private $videoModel;
	private $tagModel;
	private $thumbnailModel;
	private $sizeLimit = 250 * 1024 * 1024;
    private $allowedTypes = ['mp4', 'flv', 'webm', 'mkv', 'vob', 'ogv', 'ogg', 'avi', 'wmv', 'mov', 'mpeg', 'mpg'];

    // private $ffmpegPath = 'ffmpeg/bin/ffmpeg'; for mac
    private $ffmpegPath; // for windows
    private $ffprobePath;

/////////////////////////////////////////////////////////////

    public function __construct()
    {
    	$this->videoModel = $this->model('Video');
    	$this->tagModel = $this->model('Tag');
    	$this->thumbnailModel = $this->model('Thumbnail');

        $this->ffmpegPath = realpath('../app/lib/ffmpeg/bin/ffmpeg.exe'); // for windows
	    $this->ffprobePath = realpath('../app/lib/ffmpeg/bin/ffprobe.exe'); // for windows
    }

/////////////////////////////////////////////////////////////

    public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['videoTitle']) && isset($_FILES['fileInput'])) {

				// sanitize POST data
				$videoTitle = trim(filter_input(INPUT_POST, 'videoTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
				$videoDesc = trim(filter_input(INPUT_POST, 'videoDesc', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
				$videoCat = filter_input(INPUT_POST, 'videoCat', FILTER_VALIDATE_INT);
				$videoPriv = filter_input(INPUT_POST, 'videoPrivacy', FILTER_VALIDATE_INT);
				$videoComm = filter_input(INPUT_POST, 'comments', FILTER_VALIDATE_INT);
				$videoTags = trim(filter_input(INPUT_POST, 'videoTags', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

				// validate file
				$this->validateVideo($_FILES['fileInput']);

				// validate title
				$this->validateTitle($videoTitle);

				
				// init data
				$data = [
					'file' => $_FILES['fileInput'],
					'videoTitle' => $videoTitle,
					'videoDesc' => $videoDesc,
					'videoCat' => $videoCat,
					'videoPriv' => $videoPriv,
					'videoComm' => $videoComm,
					'videoTags' => $videoTags
				];

				// upload video
				$this->upload($data);
			}
		}
	}

/////////////////////////////////////////////////////////////

	private function validateVideo($file)
	{
		// if file is select or no
	    if ($file['name'] === '') {
			$data = [
				'status' => 0,
				'msg' => 'Please select file'
			];

			echo json_encode($data);
			exit;
		}

		// validate file size
		if ($file['size'] > $this->sizeLimit) {
			$data = [
				'status' => 0,
				'msg' => 'The file must be less than 250MB'
			];

			echo json_encode($data);
			exit;
		}

		// validate file type
		$videoType = pathInfo($file['name'], PATHINFO_EXTENSION);

		if (!$this->isValidType($videoType)) {
			$data = [
				'status' => 0,
				'msg' => 'Invalid file type'
			];

			echo json_encode($data);
			exit;
		}
	}

/////////////////////////////////////////////////////////////

	private function validateTitle($title)
	{
	    if (empty($title)) {
			$data = [
				'status' => 0,
				'msg' => 'Please enter title'
			];

			echo json_encode($data);
			exit;
		}
	}

/////////////////////////////////////////////////////////////

	private function isValidType($type)
	{
	    $lowercased = strtolower($type);
	    return in_array($lowercased, $this->allowedTypes);
	}

/////////////////////////////////////////////////////////////

	private function upload($data)
	{
		// upload directory
	    $targetDir = "uploads/videos/";

	    // temporary file path
	    $tempFilePath = $targetDir . uniqid() . '_' . basename($data['file']['name']);
	    $tempFilePath = str_replace(' ', '_', $tempFilePath);


	    if (move_uploaded_file($data['file']['tmp_name'], $tempFilePath)) {
	    	
	    	// final file path
	    	$finalFilePath = $targetDir . uniqid() . '.mp4';

	    	// insert data to DB
	    	$videoId = $this->insertDataToDB($data, $finalFilePath);

	    	if (!$videoId) {
	    		$data = [
					'status' => 0,
					'msg' => 'Insert query failed'
				];

				echo json_encode($data);
				exit;
	    	}

	    	// convert video to mp4
	    	if (!$this->convertVideoToMp4($tempFilePath, $finalFilePath)) {
	    		$data = [
					'status' => 0,
					'msg' => 'Upload failed'
				];

				echo json_encode($data);
				exit;
	    	}

	    	// delete temporary file path
	    	if (!$this->deleteFile($tempFilePath)) {
	    		$data = [
					'status' => 0,
					'msg' => 'Upload failed'
				];

				echo json_encode($data);
				exit;
	    	}

	    	// generate thumbnails for video
	    	if (!$this->generateThumbnails($videoId, $finalFilePath)) {
	    		$data = [
					'status' => 0,
					'msg' => 'Could not generate thumbnails'
				];

				echo json_encode($data);
				exit;
	    	}

	    	$data = [
				'status' => 1,
				'msg' => 'Upload successful'
			];
	    	echo json_encode($data);
	    }
	}

/////////////////////////////////////////////////////////////

	private function insertDataToDB($data, $filePath)
	{
	    if ($videoId = $this->videoModel->insertVideoData($data, $filePath)) {
	    	// insert tags in DB
    		if (!empty($data['videoTags'])) {
    			$tags = explode(',', $data['videoTags']);

				$allTags = array_map(function($tag){
					return trim($tag);
				}, $tags);

				foreach ($allTags as $tag) {
					$this->tagModel->insertTags($tag, $videoId);
				}
    		}

    		return $videoId;
	    }else{
	    	return false;
	    }
	}

/////////////////////////////////////////////////////////////

	private function convertVideoToMp4($tempFilePath, $finalFilePath)
	{
	    $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

	    $outputLog = [];
	    exec($cmd, $outputLog, $returnCode);

	    return ($returnCode != 0) ? false : true;
	}

///////////////////////////////////////////////////////////////

	private function deleteFile($filePath)
	{
	   return (!unlink($filePath)) ? false : true;
	}

////////////////////////////////////////////////////////////////

	private function generateThumbnails($videoId, $filePath)
	{
	    $thumbnailSize = '490x280';
	    $numThumbnails = 3;
	    $pathToThumbnail = "uploads/videos/thumbnails";

	    // video duration
	    $duration = $this->getVideoDuration($filePath);

	    // update duration
	    $this->updateDuration($duration, $videoId);


	    // create thumbnail
	    for ($i = 1; $i <= $numThumbnails ; $i++) { 
	    	$imageName = uniqid() . '.jpg';
	    	$interval = ($duration * 0.8) / $numThumbnails * $i;
	    	$fullThumbnailPath = "$pathToThumbnail/$videoId-$imageName";

	    	$cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

	    	$outputLog = [];
		    exec($cmd, $outputLog, $returnCode);

		    $selected = ($i == 1) ? 1 : 0;

		    if (!$this->thumbnailModel->insertThumbnails($videoId, $fullThumbnailPath, $selected)) {
		    	return false;
		    }
	    }

	    return true;
	}

///////////////////////////////////////////////////////////////

	private function getVideoDuration($file)
	{
	    return (int) shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $file");
	}

///////////////////////////////////////////////////////////////

	private function updateDuration($duration, $videoId)
	{
	    $hours = floor($duration / 3600);
	    $mins = floor(($duration - ($hours * 3600)) / 60);
	    $secs = floor($duration % 60);

	    $hours = ($hours < 1) ? '' : "{$hours}:";
	    $mins = ($mins < 10) ? "0{$mins}:" : "{$mins}:";
	    $secs = ($secs < 10) ? "0{$secs}" : $secs;

	    $dur = $hours . $mins . $secs;

	    $this->videoModel->updateDuration($dur, $videoId);
	}

///////////////////////////////////////////////////////////////



} // end class
















 ?>