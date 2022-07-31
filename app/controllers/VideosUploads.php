<?php 
/**
 * VideoUpload Controller
 * upload video
 */
class VideosUploads extends Controller
{
	private $categoryModel;

////////////////////////////////////////////////////////////////////
	
	public function __construct()
	{
		if (!isLoggedIn()) {
			redirect('');
		}
		
	    $this->categoryModel = $this->model('Category');
	}

////////////////////////////////////////////////////////////////////

	public function index()
	{
		$categories = $this->categoryModel->getAll();

		$data = [
			'title' => 'Upload Video',
			'categories' => $categories
		];

	    $this->view('uploads/index', $data);
	}

////////////////////////////////////////////////////////////////////

	
} // end class









 ?>