<?php 

class Profiles extends Controller
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

	public function index($username)
	{	
		// $tagName = filter_var($tagName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		
		var_dump($username);

		// $data = [
		// 	'title' => "#{$tagName} - " . SITENAME,
		// 	'tagName' => $tagName,
		// 	'videosCount' => $videosCount->count,
		// 	'videos' => $videos,
		// 	'subs' => $subs
		// ];
		
	 //    $this->view('tags/profile', $data);
	}

/////////////////////////////////////////////////////////////////








	
} // end class



 ?>