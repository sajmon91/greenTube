<?php 

/**
 * Subscriber model
 */
class Subscriber
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
    $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

	//get all subscriber count
  public function getSubscriberCount($userToId)
  {
   	$this->db->query('SELECT subId FROM subscribers WHERE userToId = :id');

    $this->db->bind(':id', $userToId);

    $row = $this->db->single();

   	return $this->db->rowCount();    
  }

////////////////////////////////////////////////////////////////////////////

  // check if user is subbed
  public function isSubscribedTo($userTo, $userFrom)
  {
    $this->db->query('SELECT subId FROM subscribers WHERE userToId = :userTo AND userFromId = :userFrom');

    $this->db->bind(':userTo', $userTo);
    $this->db->bind(':userFrom', $userFrom);

    $row = $this->db->single();

    return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////

  // insert subscription
  public function insertSub($userTo, $userFrom)
  {
    $this->db->query("INSERT INTO subscribers(userToId, userFromId) VALUES(:userTo, :userFrom)");

    $this->db->bind(':userTo', $userTo);
    $this->db->bind(':userFrom', $userFrom);

    $this->db->execute();
  }
  
////////////////////////////////////////////////////////////////////////////

  // delete subscription
  public function deleteSub($userTo, $userFrom)
  {
    $this->db->query("DELETE FROM subscribers WHERE userToId = :userTo AND userFromId = :userFrom");

    $this->db->bind(':userTo', $userTo);
    $this->db->bind(':userFrom', $userFrom);

    $this->db->execute();
  }

////////////////////////////////////////////////////////////////////////////

  public function getSubscriptions()
  {
    $userFrom = $_SESSION['user_id'] ?? null;

    $this->db->query("SELECT u.userId, u.username, u.profilePic FROM subscribers AS s INNER JOIN users AS u ON s.userToId = u.userId WHERE s.userFromId = :userFrom");

    $this->db->bind(':userFrom', $userFrom);

    return $this->db->resultSet();
  }

////////////////////////////////////////////////////////////////////////////


	
} // end class














 ?>