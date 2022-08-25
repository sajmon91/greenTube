<?php 

class Tags extends Controller
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

	public function index($tagName)
	{	
		$tagName = filter_var($tagName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		$videoIdByTagName = $this->tagModel->getVideoIdByTagName($tagName);

		$videosCount = $this->tagModel->getVideosCountByTag($tagName);

		$videos = array_map(function($videoId){
			return $this->videoModel->getVideosByTag($videoId->videoId);
		}, $videoIdByTagName);

		$subs = $this->subscriberModel->getSubscriptions();

		$data = [
			'title' => "#{$tagName} - " . SITENAME,
			'tagName' => $tagName,
			'videosCount' => $videosCount->count,
			'videos' => $videos,
			'subs' => $subs
		];
		
	    $this->view('tags/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class



 ?>