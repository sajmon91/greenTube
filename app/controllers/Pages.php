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

		// var_dump($data);

	    $this->view('pages/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class









 ?>