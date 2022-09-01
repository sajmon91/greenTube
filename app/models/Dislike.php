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

////////////////////////////////////////////////////////////////////////////

  public function insertVideoDislike($userId, $videoId)
  {
      $this->db->query("INSERT INTO dislikes(userId, videoId) VALUES(:userId, :videoId)");

      $this->db->bind(':userId', $userId);
      $this->db->bind(':videoId', $videoId);

      $this->db->execute();
  }

////////////////////////////////////////////////////////////////////////////

  public function getCommentDislikes($commId)
  {
      $this->db->query("SELECT dislikeId FROM dislikes WHERE commentId = :id");

      $this->db->bind(':id', $commId);

      $this->db->execute();

      return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////

  public function wasCommDislikedBy($userId, $commId)
  {
    $this->db->query("SELECT dislikeId FROM dislikes WHERE userId = :userId AND commentId = :commId");

    $this->db->bind(':userId', $userId);
    $this->db->bind(':commId', $commId);

    $row = $this->db->single();

    return ($this->db->rowCount() > 0) ? true : false;
  }

////////////////////////////////////////////////////////////////////////////

  public function deleteCommentDislike($userId, $commId)
  {
    $this->db->query("DELETE FROM dislikes WHERE userId = :userId AND commentId = :commId");

    $this->db->bind(':userId', $userId);
    $this->db->bind(':commId', $commId);

    $row = $this->db->single();

    return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////

  public function insertCommentDislike($userId, $commId)
  {
    $this->db->query("INSERT INTO dislikes(userId, commentId) VALUES(:userId, :commId)");

    $this->db->bind(':userId', $userId);
    $this->db->bind(':commId', $commId);

    $this->db->execute();
  }

////////////////////////////////////////////////////////////////////////////





} // end class














 ?>