<?php 

class Subscribers extends Controller
{
	private $subscriberModel;

	public function __construct()
	{
	    $this->subscriberModel = $this->model('Subscriber');
	}

/////////////////////////////////////////////////////////////////

	public function index()
	{
		
	}

/////////////////////////////////////////////////////////////////

	public function subscribe()
	{
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));

		    $subId = (int)json_decode($content);
		    $userId = $_SESSION['user_id'];

		    // check if user is subbed
		    $isSubscribedTo = $this->subscriberModel->isSubscribedTo($subId, $userId);

		    if ($isSubscribedTo === 0) {
		    	// if not subbed - insert
		    	$this->subscriberModel->insertSub($subId, $userId);

		    }else{
		    	// if subbed - delete
		    	$this->subscriberModel->deleteSub($subId, $userId);
		    }
		}
	    
	}

/////////////////////////////////////////////////////////////////






	
} // end class









 ?>