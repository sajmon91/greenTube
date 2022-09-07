<?php 

class Pages extends Controller
{
	private $videoModel;
	private $tagModel;
	private $subscriberModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->tagModel = $this->model('Tag');
	    $this->subscriberModel = $this->model('Subscriber');
	}

/////////////////////////////////////////////////////////////////

	public function index()
	{
		$videos = $this->videoModel->getRandomVideos();
		$tags = $this->tagModel->getRandomTags();
		$subs = $this->subscriberModel->getSubscriptions();
		
		$data = [
			'videos' => $videos,
			'tags' => $tags,
			'subs' => $subs
		];

	    $this->view('pages/index', $data);
	}

/////////////////////////////////////////////////////////////////

	public function trending()
	{
	    $videos = $this->videoModel->getTrendingVideos();
	    $subs = $this->subscriberModel->getSubscriptions();

	    $data = [
	    	'title' => "Trending - " . SITENAME,
	    	'videos' => $videos,
			'subs' => $subs
	    ];

	    $this->view('pages/trending', $data);
	}

/////////////////////////////////////////////////////////////////

	public function subscriptions()
	{
		if (!isLoggedIn()) {
			redirect('users/signin');
		}

	    $subs = $this->subscriberModel->getSubscriptions();

	    $videos = $this->videoModel->getSubscriptionsVideos($subs);

	    $data = [
	    	'title' => "Subscriptions - " . SITENAME,
	    	'videos' => $videos,
			'subs' => $subs
	    ];

	    $this->view('pages/subscriptions', $data);
	}


/////////////////////////////////////////////////////////////////





	
} // end class









 ?>