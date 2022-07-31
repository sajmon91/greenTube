<?php 
/**
 * User Controller
 * register and login user
 */
class Users extends Controller
{
	private $userModel;

	public function __construct()
	{
	    $this->userModel = $this->model('User');
	}

/////////////////////////////////////////////////////////

	// register user
	public function signUp()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// sanitize POST data
			$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$email2 = filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL);
			$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$pass2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			// default profile picture assignment
			$pics = scandir(ROOT . '/public/assets/images/profilePictures/defaults');
      		$rand = rand(2, count($pics) - 1);
			$pic = $pics[$rand];
      		$profilePic = "/public/assets/images/profilePictures/defaults/${pic}";

			// init data
	      	$data = [
				'firstName' => trim(ucfirst(mb_strtolower($firstName, 'UTF-8'))),
				'lastName' => trim(ucfirst(mb_strtolower($lastName, 'UTF-8'))),
	        	'username' => trim($username),
	        	'email' => trim($email),
				'email2' => trim($email2),
	        	'password' => trim($pass),
				'password2' => trim($pass2),
				'profilePic' => $profilePic,
				'firstNameErr' => '',
				'lastNameErr' => '',
	        	'usernameErr' => '',
	        	'emailErr' => '',
				'email2Err' => '',
	        	'passwordErr' => '',
				'password2Err' => ''
	      	];

	      	// validate first name
	      	$data['firstNameErr'] = $this->validateFirstName($data['firstName']);

	      	// validate last name
	      	$data['lastNameErr'] = $this->validateLastName($data['lastName']);

	      	// validate username
	      	$data['usernameErr'] = $this->validateUsername($data['username']);

	      	// validate email
	      	$data['emailErr'] = $this->validateEmail($data['email'], $data['email2']);
	      	$data['email2Err'] = $this->validateEmail($data['email2'], $data['email']);

	      	// validate password
	      	$data['passwordErr'] = $this->validatePassord($data['password'], $data['password2']);
	      	$data['password2Err'] = $this->validatePassord($data['password2'], $data['password']);

	      	// make sure errors are empty
	      	if (empty($data['firstNameErr']) && empty($data['lastNameErr']) && empty($data['usernameErr']) && empty($data['emailErr']) && empty($data['email2Err']) && empty($data['passwordErr']) && empty($data['password2Err'])) {
	      		
	      		// hash password
	        	$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

	        	// register user
	        	if ($this->userModel->register($data)) {
	        		setMessage('You are registered and now can log in');
	        		redirect('users/signIn');
	        	}

	      	}else{

	      		//load view with errors
				$this->view('users/signUp', $data);
	      	}
			
		}else{
			// init data
      		$data = [
				'firstName' => '',
				'lastName' => '',
        		'username' => '',
        		'email' => '',
				'email2' => '',
        		'password' => '',
				'password2' => '',
				'firstNameErr' => '',
				'lastNameErr' => '',
        		'usernameErr' => '',
        		'emailErr' => '',
				'email2Err' => '',
        		'passwordErr' => '',
				'password2Err' => ''
      		];

			//load view
			$this->view('users/signUp', $data);
		}
	    
	}

///////////////////////////////////////////////////

	// login user
	public function signIn()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// sanitize post data
      		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      		// init data
		    $data = [
		        'username' => trim($username),
		        'password' => trim($password),
		        'usernameErr' => '',
		        'passwordErr' => ''
		    ];

		    // validate username
		    if (empty($username)) {
	      		$data['usernameErr'] = 'Please enter username';

	      	}else if (!$this->userModel->findUserByUsername($username)) {
	      		$data['usernameErr'] =  'Wrong username';
	      	}

	      	// validate password
	      	if (empty($password)) {
	      		$data['passwordErr'] = 'Please enter password';
	      	}

	      	// make sure errors are empty
	      	if (empty($data['usernameErr']) && empty($data['passwordErr'])) {

	      		//check and set logged in user
	        	$loggedInUser = $this->userModel->login($data['username'], $data['password']);

	        	if ($loggedInUser) {
	        		// create sessions
	        		$this->createUserSession($loggedInUser);
	        	}else{
	        		$data['passwordErr'] = 'Wrong password';
	        	}
	        }

	      	// load view with errors
	    	$this->view('users/signIn', $data);
	      	

		}else{

			// init data
		    $data = [
		        'username' => '',
		        'password' => '',
		        'usernameErr' => '',
		        'passwordErr' => ''
		    ];

		    // load view
	    	$this->view('users/signIn', $data);
		}
	}

///////////////////////////////////////////////////

	private function validateFirstName($firstName)
	{
	    if (empty($firstName)) {
      		return 'Please enter first name';
      	}

      	if (strlen($firstName) > 25 || strlen($firstName) < 2) {
      		return 'Your first name must be between 2 and 25 characters';
      	}
	}

///////////////////////////////////////////////////

	private function validateLastName($lastName)
	{
	    if (empty($lastName)) {
      		return 'Please enter last name';
      	}

      	if (strlen($lastName) > 25 || strlen($lastName) < 2) {
      		return 'Your last name must be between 2 and 25 characters';
      	}
	}

///////////////////////////////////////////////////

	private function validateUsername($username)
	{
		$specialChars = "/^[0-9a-zA-Z]*$/";

	    if (empty($username)) {
      		return 'Please enter username';
      	}

      	if (strlen($username) > 25 || strlen($username) < 5) {
      		return 'Your username must be between 5 and 25 characters';
      	}

      	if (!preg_match($specialChars, $username)) {
      		return 'Username must be only letters and numbers';
      	}

      	if ($this->userModel->findUserByUsername($username)) {
      		return 'Username is already taken';
      	}
	}

///////////////////////////////////////////////////

	private function validateEmail($email, $email2)
	{
		$mailFormat = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";

	    if (empty($email)) {
      		return 'Please enter email';
      	}

      	if (!preg_match($mailFormat, $email)) {
      		return 'Invalid email';
      	}

      	if ($email !== $email2) {
      		return 'Your emails do not match';
      	}

      	if ($this->userModel->findUserByEmail($email)) {
      		return 'Email is already taken';
      	}
	}

//////////////////////////////////////////////////////

	private function validatePassord($pass, $pass2)
	{
		$specialChars = "/^[0-9a-zA-Z]*$/";

	    if (empty($pass)) {
      		return 'Please enter password';
      	}

      	if (strlen($pass) > 30 || strlen($pass) < 5) {
      		return 'Your password must be between 5 and 30 characters';
      	}

      	if (!preg_match($specialChars, $pass)) {
      		return 'Password must be only letters and numbers';
      	}

      	if ($pass !== $pass2) {
      		return 'Your passwords do not match';
      	}
	}

//////////////////////////////////////////////////////

	private function createUserSession($user)
	{
	    $_SESSION['user_id'] = $user->userId;
	    $_SESSION['username'] = $user->username;
	    $_SESSION['profile_pic'] = $user->profilePic;
    	redirect('');
	}

//////////////////////////////////////////////////////

	// logout user and session destroy
	public function logout()
	{
	    session_destroy();
	    redirect('');
	}

//////////////////////////////////////////////////////

} // end class













 ?>