<?php 

class Pages extends Controller
{

	public function index()
	{
		$data = [
			'title' => 'my title'
		];

	    $this->view('pages/index');
	}

	
} // end class









 ?>