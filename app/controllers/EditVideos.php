<?php 

class EditVideos extends Controller
{
	private $videoModel;
	private $subscriberModel;
	private $categoryModel;
	private $thumbnailModel;
	private $tagModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->subscriberModel = $this->model('Subscriber');
	    $this->categoryModel = $this->model('Category');
	    $this->thumbnailModel = $this->model('Thumbnail');
	    $this->tagModel = $this->model('Tag');
	}

/////////////////////////////////////////////////////////////////

	public function index($videoId)
	{	
		if (!isLoggedIn()) {
			redirect('');
		}

		$videoId = (int) filter_var($videoId, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$videoInfo = $this->videoModel->getVideoById($videoId);

		if ($videoInfo->uploadedBy !== $_SESSION['user_id']) {
			redirect('');
		}

		$videoThumbnails = $this->thumbnailModel->getVideoThumbnails($videoId);
		$allCategories = $this->categoryModel->getAll();
		$subs = $this->subscriberModel->getSubscriptions();

		$videoTags = array_map(function($el){
			return $el->tagName;
		}, $this->tagModel->getTagsByVideoId($videoId));

		$videoTags = implode(', ' , $videoTags);
		
		$data = [
			'title' => 'Edit Video - ' . SITENAME,
			'video' => $videoInfo,
			'videoThumbnails' => $videoThumbnails,
			'videoTags' => $videoTags,
			'categories' => $allCategories,
			'subs' => $subs
		];
		
	    $this->view('editVideos/index', $data);
	}

/////////////////////////////////////////////////////////////////

	public function updateThumbnail()
	{
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    	if (isset($_POST['videoId']) && isset($_POST['thumbId'])) {
	    		$videoId = (int) trim(filter_input(INPUT_POST, 'videoId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
	    		$thumbId = (int) trim(filter_input(INPUT_POST, 'thumbId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


	    		if ($this->thumbnailModel->update($videoId, $thumbId)) {
	    			$data = [
						'status' => 1,
						'msg' => 'Thumbnail updated'
					];

	    			echo json_encode($data);
	    		}
	    	}	
	    }
	}

/////////////////////////////////////////////////////////////////

	public function updateVideoInfo()
	{
	    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	    	if (isset($_POST['videoTitle']) && isset($_POST['videoId'])) {

	    		$videoId = filter_input(INPUT_POST, 'videoId', FILTER_VALIDATE_INT);
	    		$videoTitle = trim(filter_input(INPUT_POST, 'videoTitle', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
	    		$videoDesc = trim(filter_input(INPUT_POST, 'videoDesc', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
				$videoCat = filter_input(INPUT_POST, 'videoCat', FILTER_VALIDATE_INT);
				$videoPri = filter_input(INPUT_POST, 'videoPri', FILTER_VALIDATE_INT);
				$videoComm = filter_input(INPUT_POST, 'comments', FILTER_VALIDATE_INT);
				$videoTags = trim(filter_input(INPUT_POST, 'videoTags', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

				// validate title
				if (empty($videoTitle)) {
					$data = [
						'status' => 0,
						'msg' => 'Please enter title'
					];

					echo json_encode($data);
					exit;
				}

				// init data
				$data = [
					'videoId' => $videoId,
					'videoTitle' => $videoTitle,
					'videoDesc' => $videoDesc,
					'videoCat' => $videoCat,
					'videoPri' => $videoPri,
					'videoComm' => $videoComm,
					'videoTags' => $videoTags
				];

				// update video info
				if ($this->videoModel->updateVideoInfo($data)) {
					// delete video tags
					$this->tagModel->deleteVideoTags($videoId);

					// insert new tags
					if (!empty($videoTags)) {
		    			$tags = explode(',', $videoTags);

						$allTags = array_map(function($tag){
							return trim($tag);
						}, $tags);

						foreach ($allTags as $tag) {
							$this->tagModel->insertTags($tag, $videoId);
						}
		    		}
		    		
		    		$data = [
						'status' => 1,
						'msg' => 'Updated Successfully'
					];

					echo json_encode($data);
				}
	    		
	    	}	
	    }
	}

/////////////////////////////////////////////////////////////////






	
} // end class



 ?>