<?php 

class Profiles extends Controller
{
	private $userModel;
	private $videoModel;
	private $subscriberModel;

	public function __construct()
	{
		$this->userModel = $this->model('User');
	    $this->videoModel = $this->model('Video'); 
	    $this->subscriberModel = $this->model('Subscriber');
	}

/////////////////////////////////////////////////////////////////

	public function index($username)
	{	
		$username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$userData = $this->userModel->getUserDataByUsername($username);

		$subs = $this->subscriberModel->getSubscriptions();
		$isSubscribedTo = $this->subscriberModel->isSubscribedTo($userData->userId, $_SESSION['user_id'] ?? null);
		$subsCount = $this->subscriberModel->getSubscriberCount($userData->userId);

		$isMyProfile = (($_SESSION['user_id'] ?? null) === $userData->userId) ? true : false;

		$videosViews = $this->videoModel->getVideosTotalViews($userData->userId)->vidViews;
		$videosCount = $this->videoModel->getVideosCount($userData->userId)->videoCount;
		$userVideos = $this->videoModel->getVideosByUser($userData->userId);

		$data = [
			'title' => "{$username} - " . SITENAME,
			'userData' => $userData,
			'subs' => $subs,
			'isSubscribedTo' => $isSubscribedTo,
			'subsCount' => $subsCount,
			'isMyProfile' => $isMyProfile,
			'videosViews' => $videosViews,
			'videosCount' => $videosCount,
			'videos' => $userVideos
		];

	    $this->view('profiles/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class



 ?>