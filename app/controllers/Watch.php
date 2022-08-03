<?php 

class Watch extends Controller
{
	private $videoModel;
	private $tagModel;
	private $userModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->tagModel = $this->model('Tag');
	    $this->userModel = $this->model('User');
	}

/////////////////////////////////////////////////////////////////

	public function index($videoId)
	{
		// update views of video
		$this->videoModel->updateViews($videoId);

		// get video, tags, user upload info,videos by category by video id
		$video = $this->videoModel->getVideoById($videoId);
		$tags = $this->tagModel->getTagsByVideoId($videoId);
		$user = $this->userModel->getUserDataById($video->uploadedBy);
		$videosByCat = $this->videoModel->getVideosByCategory($video->category, $video->videoId);

		 
		// init data
		$data = [
			'title' => $video->title,
			'video' => $video,
			'tags' => $tags,
			'user' => $user,
			'catVideos' => $videosByCat
		];

		// var_dump($videosByCat);

		// load view
	    $this->view('watch/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class









 ?>