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
		$videoIdByTagName = $this->tagModel->getVideoIdByTagName($tagName);

		$videos = array_map(function($videoId){
			return $this->videoModel->getVideosByTag($videoId->videoId);
		}, $videoIdByTagName);
		

	    $this->view('tags/index', $videos);
	}

/////////////////////////////////////////////////////////////////








	
} // end class



 ?>