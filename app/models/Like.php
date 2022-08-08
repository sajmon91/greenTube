<?php 

/**
 * Like model
 */
class Like
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
      $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

  // get likes count
  public function getLikes($videoId)
  {
   	$this->db->query('SELECT COUNT(likeId) as likeCount FROM likes WHERE videoId = :videoId');

   	$this->db->bind(':videoId', $videoId);

    return $this->db->single();
  }

////////////////////////////////////////////////////////////////////////////

  public function wasLikedBy($userId, $videoId)
  {
      $this->db->query("SELECT likeId FROM likes WHERE userId = :userId AND videoId = :videoId");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $row = $this->db->single();

      return ($this->db->rowCount() > 0) ? true : false;

  }

////////////////////////////////////////////////////////////////////////////

  public function insertVideoLike($userId, $videoId)
  {
      $this->db->query("INSERT INTO likes(userId, videoId) VALUES(:userId, :videoId)");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $this->db->execute();
  }

////////////////////////////////////////////////////////////////////////////

  public function deleteVideoLike($userId, $videoId)
  {
      $this->db->query("DELETE FROM likes WHERE userId = :userId AND videoId = :videoId");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $row = $this->db->single();

      return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////


	
} // end class














 ?>