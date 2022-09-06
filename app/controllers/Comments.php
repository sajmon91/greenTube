<?php 

class Comments extends Controller
{
	private $commentModel;
	private $likeModel;
	private $dislikeModel;

	public function __construct()
	{
	    $this->commentModel = $this->model('Comment');
	    $this->likeModel = $this->model('Like');
	    $this->dislikeModel = $this->model('Dislike');
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

	public function commentLike()
	{
	    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));
			$decode = json_decode($content);

			$userId = $_SESSION['user_id'];
		    $commId = (int) trim(filter_var($decode, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

		 	if ($this->likeModel->wasCommLikedBy($userId, $commId)) {
		 		
		 		$this->likeModel->deleteCommentLike($userId, $commId);

		    	$result = [
		    		'likes' => -1,
		    		'dislikes' => 0
		    	];

	    		echo json_encode($result);

		 	}else{
		 		
		 		$count = $this->dislikeModel->deleteCommentDislike($userId, $commId);

		    	$this->likeModel->insertCommentLike($userId, $commId);

		    	$result = [
		    		'likes' => 1,
		    		'dislikes' => 0 - $count
		    	];

		    	echo json_encode($result);
		 	}
		}
	}

/////////////////////////////////////////////////////////////////

	public function commentDislike()
	{
	    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));
			$decode = json_decode($content);

			$userId = $_SESSION['user_id'];
		    $commId = (int) trim(filter_var($decode, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

		 	if ($this->dislikeModel->wasCommDislikedBy($userId, $commId)) {
		 		
		 		$this->dislikeModel->deleteCommentDislike($userId, $commId);

		    	$result = [
		    		'likes' => 0,
		    		'dislikes' => -1
		    	];

	    		echo json_encode($result);

		 	}else{
		 		
		 		$count = $this->likeModel->deleteCommentLike($userId, $commId);

		    	$this->dislikeModel->insertCommentDislike($userId, $commId);

		    	$result = [
		    		'likes' => 0 - $count,
		    		'dislikes' => 1
		    	];

		    	echo json_encode($result);
		 	}
		}
	}

/////////////////////////////////////////////////////////////////

	public function commentReply()
	{
	    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));
			$decode = json_decode($content);

			$userId = $_SESSION['user_id'];
			$videoId = (int) trim(filter_var($decode->videoId, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
		    $commId = (int) trim(filter_var($decode->commId, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
		    $commBody = trim(filter_var($decode->commBody, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

		    $date = date("Y-m-d H:i:s");

		    if (!empty($commBody)) {
		    	$this->commentModel->insertReplyComment($userId, $videoId, $commId, $commBody, $date);

		    	$data = [
			    	'body' => $commBody,
			    	'date' => Formater::timeAgo($date)
			    ];

			    echo json_encode($data);
		    }
		}
	}

/////////////////////////////////////////////////////////////////

	public function getCommentReplies()
	{
	    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if ($contentType === "application/json") {

			$content = trim(file_get_contents('php://input'));
			$decode = json_decode($content);

		    $commId = (int) trim(filter_var($decode, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

		    $comms = $this->commentModel->getReplies($commId);

		    $comments = array_map(function($el){
				$comLikes = $this->likeModel->getCommentLikes($el->commentId);
				$comDislikes = $this->dislikeModel->getCommentDislikes($el->commentId);
				$wasLikedComm = $this->likeModel->wasCommLikedBy($_SESSION['user_id'] ?? null, $el->commentId);
				$wasDislikedComm = $this->dislikeModel->wasCommDislikedBy($_SESSION['user_id'] ?? null, $el->commentId);

				return [
					'com' => $el,
					'likes' => $comLikes,
					'dislikes' => $comDislikes,
					'wasLiked' => $wasLikedComm,
					'wasDisliked' => $wasDislikedComm,
					'date' => Formater::timeAgo($el->datePosted)
				];
			}, $comms);

		    echo json_encode($comments);
		    
		}
	}

/////////////////////////////////////////////////////////////////






	
} // end class









 ?>