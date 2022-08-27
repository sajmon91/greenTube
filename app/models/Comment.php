<?php 

/**
 * Comment model
 */
class Comment
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  public function __construct()
  {
      $this->db = new Database;
  }

////////////////////////////////////////////////////////////////////////////

	//get all video comments
  public function getAllVideoComments($videoId)
  {
    $this->db->query("SELECT c.*, u.userId, u.username, u.profilePic FROM comments AS c LEFT JOIN users AS u ON c.postedBy = u.userId WHERE c.videoId = :videoId AND c.responseTo = 0 ORDER BY c.commentId DESC");

    $this->db->bind(':videoId', $videoId);

   	return $this->db->resultSet();    
  }

////////////////////////////////////////////////////////////////////////////

  public function getNumberOfReplies($comId)
  {
    $this->db->query("SELECT commentId FROM comments WHERE responseTo = :id");
    $this->db->bind(':id', $comId);
    $this->db->execute();

    return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////

  public function getNumberOfComments($videoId)
  {
    $this->db->query("SELECT commentId FROM comments WHERE videoId = :videoId");
    $this->db->bind(':videoId', $videoId);
    $this->db->execute();

    return $this->db->rowCount();
  }

////////////////////////////////////////////////////////////////////////////


	
} // end class














 ?>