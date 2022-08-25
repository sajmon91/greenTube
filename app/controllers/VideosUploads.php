<?php 
/**
 * VideoUpload Controller
 * upload video
 */
class VideosUploads extends Controller
{
	private $categoryModel;
	private $subscriberModel;

////////////////////////////////////////////////////////////////////
	
	public function __construct()
	{
		if (!isLoggedIn()) {
			redirect('');
		}
		
	    $this->categoryModel = $this->model('Category');
	    $this->subscriberModel = $this->model('Subscriber');
	}

////////////////////////////////////////////////////////////////////

	public function index()
	{
		$categories = $this->categoryModel->getAll();
		$subs = $this->subscriberModel->getSubscriptions();

		$data = [
			'title' => 'Upload Video',
			'categories' => $categories,
			'subs' => $subs
		];

	    $this->view('uploads/index', $data);
	}

////////////////////////////////////////////////////////////////////

	
} // end class









 ?>