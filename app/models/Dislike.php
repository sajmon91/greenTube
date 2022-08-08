<?php 

/**
 * Dislike model
 */
class Dislike
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
      $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

  // get dislikes count
  public function getDislikes($videoId)
  {
   	$this->db->query('SELECT COUNT(dislikeId) as dislikeCount FROM dislikes WHERE videoId = :videoId');

   	$this->db->bind(':videoId', $videoId);

    return $this->db->single();
  }

////////////////////////////////////////////////////////////////////////////

  public function deleteVideoDislike($userId, $videoId)
  {
      $this->db->query("DELETE FROM dislikes WHERE userId = :userId AND videoId = :videoId");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $row = $this->db->single();

      return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////

  public function wasVideoDislikedBy($userId, $videoId)
  {
      $this->db->query("SELECT dislikeId FROM dislikes WHERE userId = :userId AND videoId = :videoId");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $row = $this->db->single();

      return ($this->db->rowCount() > 0) ? true : false;
  }



	
} // end class














 ?>