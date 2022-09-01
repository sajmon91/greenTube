<?php 

class Comments extends Controller
{
	private $commentModel;

	public function __construct()
	{
	    $this->commentModel = $this->model('Comment');
	}

/////////////////////////////////////////////////////////////////

	public function index()
	{
		
	}

/////////////////////////////////////////////////////////////////

	public function postComment()
	{
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));
			$decode = json_decode($content);

			$userId = $_SESSION['user_id'];
		    $videoId = (int) $decode->videoId;
		    $comBody = trim(filter_var($decode->bodyText, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
		    $date = date("Y-m-d H:i:s");

		    $this->commentModel->insertComment($userId, $videoId, $comBody, $date);

		    $data = [
		    	'body' => $comBody,
		    	'date' => Formater::timeAgo($date)
		    ];

		    echo json_encode($data);
		    
		}
	    
	}

/////////////////////////////////////////////////////////////////






	
} // end class









 ?>