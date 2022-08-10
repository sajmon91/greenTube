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

  public function isSubscribedTo($userTo, $userFrom)
  {
    $this->db->query('SELECT subId FROM subscribers WHERE userToId = :userTo AND userFromId = :userFrom');

    $this->db->bind(':userTo', $userTo);
    $this->db->bind(':userFrom', $userFrom);

    $row = $this->db->single();

    return $this->db->rowCount();
  }




	
} // end class














 ?>