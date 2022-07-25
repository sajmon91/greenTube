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

	    $this->db->query('INSERT INTO users (firstName, lastName, username, email, password, signUpDate, profilePic) VALUES (:firstName, :lastName, :username, :email, :password, :signUpDate, :profilePic)');

	    // bind values
	    $this->db->bind(':firstName', $data['firstName']);
	    $this->db->bind(':lastName', $data['lastName']);
	    $this->db->bind(':username', $data['username']);
	    $this->db->bind(':email', $data['email']);
	    $this->db->bind(':password', $data['password']);
	    $this->db->bind(':signUpDate', $date);
	    $this->db->bind(':profilePic', $data['profilePic']);

	    // execute
	    if ($this->db->execute()) {
	      return true;
	    }else{
	      return false;
	    }
	}

////////////////////////////////////////////////////////////////////////////


	
} // end class














 ?>