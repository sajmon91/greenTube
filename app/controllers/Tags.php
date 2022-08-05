<?php 

class Tags extends Controller
{
	private $videoModel;
	private $tagModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->tagModel = $this->model('Tag');
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

		$data = [
			'tagName' => $tagName,
			'videosCount' => $videosCount->count,
			'videos' => $videos
		];
		
	    $this->view('tags/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class



 ?>