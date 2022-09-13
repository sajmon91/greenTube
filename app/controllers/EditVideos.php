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







	
} // end class



 ?>