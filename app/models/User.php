<?php 

/**
 * User model
 */
class User
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
      $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

	//find user by username
  public function findUserByUsername($username)
  {
     	$this->db->query('SELECT userId FROM users WHERE username = :username');
     	// bind value
     	$this->db->bind(':username', $username);

     	$row = $this->db->single();

     	// check row
     	if ($this->db->rowCount() > 0) {
       	return true;
     	}else{
       	return false;
     	}
  }

////////////////////////////////////////////////////////////////////////////

  // find user by email
	public function findUserByEmail($email)
	{
	    $this->db->query('SELECT userId FROM users WHERE email = :email');
	    // bind value
	    $this->db->bind(':email', $email);

	    $row = $this->db->single();

	    // check row
	    if ($this->db->rowCount() > 0) {
	      	return true;
	    }else{
	        return false;
	    }
	}

////////////////////////////////////////////////////////////////////////////

	//register user, insert data in DB
	public function register($data)
	{
	    $date = date("Y-m-d H:i:s");

	    $this->db->query('INSERT INTO users (firstName, lastName, username, email, password, signUpDate, profilePic, coverPic) VALUES (:firstName, :lastName, :username, :email, :password, :signUpDate, :profilePic, :coverPic)');

	    // bind values
	    $this->db->bind(':firstName', $data['firstName']);
	    $this->db->bind(':lastName', $data['lastName']);
	    $this->db->bind(':username', $data['username']);
	    $this->db->bind(':email', $data['email']);
	    $this->db->bind(':password', $data['password']);
	    $this->db->bind(':signUpDate', $date);
	    $this->db->bind(':profilePic', $data['profilePic']);
	    $this->db->bind(':coverPic', $data['coverPic']);

	    // execute
	    if ($this->db->execute()) {
	      return true;
	    }else{
	      return false;
	    }
	}

////////////////////////////////////////////////////////////////////////////

	// login user
	public function login($username, $password)
	{
	    $this->db->query('SELECT * FROM users WHERE username = :username');
	    $this->db->bind(':username', $username);

	    $row = $this->db->single();

	    $hashedPassword = $row->password;

	    // check for password matches
	    if (password_verify($password, $hashedPassword)) {
	      return $row;
	    }else{
	      return false;
	    }
	}

////////////////////////////////////////////////////////////////////////////

	public function getUserDataById($id)
	{
	    $this->db->query("SELECT userId, firstName, lastName, username, signUpDate, profilePic FROM users WHERE userId = :userId");

	    $this->db->bind(':userId', $id);

	    return $this->db->single();
	}

////////////////////////////////////////////////////////////////////////////

	public function getUserDataByUsername($username)
	{
    $this->db->query("SELECT userId, firstName, lastName, username, signUpDate, profilePic, coverPic, channelDesc FROM users WHERE username = :username");

    $this->db->bind(':username', $username);

    return $this->db->single();
	}

////////////////////////////////////////////////////////////////////////////




	
} // end class














 ?>