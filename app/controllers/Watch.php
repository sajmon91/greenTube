<?php 

class Watch extends Controller
{
	private $videoModel;
	private $tagModel;
	private $userModel;
	private $likeModel;
	private $dislikeModel;
	private $subscriberModel;
	private $commentModel;

	public function __construct()
	{
	    $this->videoModel = $this->model('Video');
	    $this->tagModel = $this->model('Tag');
	    $this->userModel = $this->model('User');
	    $this->likeModel = $this->model('Like');
	    $this->dislikeModel = $this->model('Dislike');
	    $this->subscriberModel = $this->model('Subscriber');
	    $this->commentModel = $this->model('Comment');
	}

/////////////////////////////////////////////////////////////////

	public function index($videoId)
	{
		// update views of video
		$this->videoModel->updateViews($videoId);

		// get video, tags, user upload info,videos by category, likes...
		$video = $this->videoModel->getVideoById($videoId);
		$tags = $this->tagModel->getTagsByVideoId($videoId);
		$user = $this->userModel->getUserDataById($video->uploadedBy);
		$videosByCat = $this->videoModel->getVideosByCategory($video->category, $video->videoId);
		$likes = $this->likeModel->getLikes($videoId)->likeCount;
		$dislikes = $this->dislikeModel->getDislikes($videoId)->dislikeCount;
		$wasLikedVideo = $this->likeModel->wasLikedBy($_SESSION['user_id'] ?? null, $videoId);
		$wasDislikedVideo = $this->dislikeModel->wasVideoDislikedBy($_SESSION['user_id'] ?? null, $videoId);

		$subsCount = $this->subscriberModel->getSubscriberCount($user->userId);
		$isSubscribedTo = $this->subscriberModel->isSubscribedTo($user->userId, $_SESSION['user_id'] ?? null);

		$isMyVideo = (($_SESSION['user_id'] ?? null) === $user->userId) ? true : false;

		$subs = $this->subscriberModel->getSubscriptions();

		$numOfComm = $this->commentModel->getNumberOfComments($video->videoId);
		$comments = $this->commentModel->getAllVideoComments($video->videoId);
		$comms = array_map(function($el){
			$comLikes = $this->likeModel->getCommentLikes($el->commentId);
			$comDislikes = $this->dislikeModel->getCommentDislikes($el->commentId);
			$numReplises = $this->commentModel->getNumberOfReplies($el->commentId);
			$wasLikedComm = $this->likeModel->wasCommLikedBy($_SESSION['user_id'] ?? null, $el->commentId);
			$wasDislikedComm = $this->dislikeModel->wasCommDislikedBy($_SESSION['user_id'] ?? null, $el->commentId);

			return [
				'com' => $el,
				'likes' => $comLikes,
				'dislikes' => $comDislikes,
				'replies' => $numReplises,
				'wasLiked' => $wasLikedComm,
				'wasDisliked' => $wasDislikedComm
			];
		}, $comments);


		if ($video->privacy && !$isMyVideo) {
			redirect('');
		}
		
		// init data
		$data = [
			'title' => $video->title,
			'video' => $video,
			'tags' => $tags,
			'user' => $user,
			'catVideos' => $videosByCat,
			'likes' => $likes,
			'dislikes' => $dislikes,
			'wasLikedVideo' => $wasLikedVideo,
			'wasDislikedVideo' => $wasDislikedVideo,
			'subsCount' => $subsCount,
			'isSubscribedTo' => $isSubscribedTo,
			'isMyVideo' => $isMyVideo,
			'subs' => $subs,
			'totalComm' => $numOfComm,
			'comments' => $comms
		];

		// load view
	    $this->view('watch/index', $data);
	}

/////////////////////////////////////////////////////////////////

	public function like()
	{
		$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if($contentType === "application/json"){

		    $content = trim(file_get_contents('php://input'));

		    $videoId = (int)json_decode($content);
		    $userId = $_SESSION['user_id'];

		    if ($this->likeModel->wasLikedBy($userId, $videoId)) {

		    	$this->likeModel->deleteVideoLike($userId, $videoId);

		    	$result = [
		    		'likes' => -1,
		    		'dislikes' => 0
		    	];

	    		echo json_encode($result);

		    }else{
		    	
		    	$count = $this->dislikeModel->deleteVideoDislike($userId, $videoId);

		    	$this->likeModel->insertVideoLike($userId, $videoId);

		    	$result = [
		    		'likes' => 1,
		    		'dislikes' => 0 - $count
		    	];

		    	echo json_encode($result);
		    }
		}
	}

/////////////////////////////////////////////////////////////////

	public function dislike()
	{
	    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

		if($contentType === "application/json"){

		    $content = trim(file_get_contents('php://input'));

		    $videoId = (int)json_decode($content);
		    $userId = $_SESSION['user_id'];

		    if ($this->dislikeModel->wasVideoDislikedBy($userId, $videoId)) {

		    	$this->dislikeModel->deleteVideoDislike($userId, $videoId);

		    	$result = [
		    		'likes' => 0,
		    		'dislikes' => -1
		    	];

	    		echo json_encode($result);

		    }else{
		    	
		    	$count = $this->likeModel->deleteVideoLike($userId, $videoId);

		    	$this->dislikeModel->insertVideoDislike($userId, $videoId);

		    	$result = [
		    		'likes' => 0 - $count,
		    		'dislikes' => 1
		    	];

		    	echo json_encode($result);
		    }
		}
	}

/////////////////////////////////////////////////////////////////





	
} // end class









 ?>