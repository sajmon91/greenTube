<?php 

class Pages extends Controller
{
	private $videoModel;
	private $tagModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->tagModel = $this->model('Tag');
	}

/////////////////////////////////////////////////////////////////

	public function index()
	{
		$videos = $this->videoModel->getRandomVideos();
		$tags = $this->tagModel->getRandomTags();
		
		$data = [
			'videos' => $videos,
			'tags' => $tags
		];

	    $this->view('pages/index', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class









 ?>