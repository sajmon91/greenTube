<?php

class Dashboards extends Controller
{
	private $videoModel;
	private $likeModel;
	private $dislikeModel;
	private $commentModel;
	private $subscriberModel;

	public function __construct()
	{
		$this->videoModel = $this->model('Video');
		$this->likeModel = $this->model('Like');
		$this->dislikeModel = $this->model('Dislike');
		$this->commentModel = $this->model('Comment');
		$this->subscriberModel = $this->model('Subscriber');
	}

	/////////////////////////////////////////////////////////////////

	public function index($userId)
	{
		if (!isLoggedIn()) {
			redirect('');
		}

		$userId = (int)filter_var($userId, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if ($userId !== $_SESSION['user_id']) {
			redirect('');
		}

		$videos = $this->videoModel->getVideosInDashboard($userId);
		$subs = $this->subscriberModel->getSubscriptions();

		$vid = array_map(function ($el) {
			$likes = $this->likeModel->getLikes($el->videoId)->likeCount;
			$dislikes = $this->dislikeModel->getDislikes($el->videoId)->dislikeCount;
			$comments = $this->commentModel->getNumberOfComments($el->videoId);

			return [
				'video' => $el,
				'likes' => $likes,
				'dislikes' => $dislikes,
				'comments' => $comments
			];
		}, $videos);

		$data = [
			'title' => "Dashboard - " . SITENAME,
			'videos' => $vid,
			'subs' => $subs
		];

		$this->view('dashboards/index', $data);
	}

	/////////////////////////////////////////////////////////////////









} // end class
