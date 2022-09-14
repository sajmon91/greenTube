<?php 

class Searches extends Controller
{
	private $videoModel;
	private $subscriberModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->subscriberModel = $this->model('Subscriber');
	}

/////////////////////////////////////////////////////////////////

	public function index($term = '', $orderBy = 'views')
	{	
		$subs = $this->subscriberModel->getSubscriptions();

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	    	if (isset($_POST['term']) && !empty($_POST['term'])) {
	    		$term = trim(filter_input(INPUT_POST, 'term', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

	    		$videos = $this->videoModel->getSearchVideos($term, $orderBy);

	    		$data = [
					'title' => "{$term} - " . SITENAME,
					'term' => $term,
					'videos' => $videos,
					'subs' => $subs
				];
				
			    $this->view('searches/index', $data);

	    	}else{
	    		redirect('');
	    	}
	    }else{
	    	$term = filter_var($term, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    	$orderBy = filter_var($orderBy, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	    	$videos = $this->videoModel->getSearchVideos($term, $orderBy);

	    	$data = [
				'title' => "{$term} - " . SITENAME,
				'term' => $term,
				'videos' => $videos,
				'subs' => $subs
			];
			
		    $this->view('searches/index', $data);
	    }
	}

/////////////////////////////////////////////////////////////////


	
} // end class



?>