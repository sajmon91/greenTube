<?php 

/**
 * Tag model
 */
class Tag
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  	public function __construct()
	{
		$this->db = new Database;
	}

////////////////////////////////////////////////////////////////////////////

	public function insertTags($tag, $videoId)
	{
		$this->db->query("INSERT INTO tags (tagName, videoId) VALUES (:tagName, :videoId)");

		// bind value
		$this->db->bind(':tagName', $tag);
		$this->db->bind(':videoId', $videoId);

		$this->db->execute();
	}

////////////////////////////////////////////////////////////////////////////

	public function getRandomTags()
	{
	    $this->db->query("SELECT * FROM tags GROUP BY tagName ORDER BY RAND() LIMIT 20");

	    return $this->db->resultSet();
	}

////////////////////////////////////////////////////////////////////////////

	public function getVideoIdByTagName($tagName)
	{
	    $this->db->query("SELECT videoId FROM tags WHERE tagName = :tagName");

	    $this->db->bind(':tagName', $tagName);
	    
	    return $this->db->resultSet();
	}

////////////////////////////////////////////////////////////////////////////

	public function getTagsByVideoId($id)
	{
	    $this->db->query("SELECT tagName FROM tags WHERE videoId = :videoId");

	    $this->db->bind(':videoId', $id);

	    return $this->db->resultSet();
	}

////////////////////////////////////////////////////////////////////////////

	public function getVideosCountByTag($tagName)
	{
	    $this->db->query("SELECT COUNT(tagId) as count FROM tags WHERE tagName = :tagName");

	    $this->db->bind(':tagName', $tagName);

	    return $this->db->single();
	}

////////////////////////////////////////////////////////////////////////////

	public function deleteVideoTags($videoId)
	{
	    $this->db->query("DELETE FROM tags WHERE videoId = :videoId");
	    $this->db->bind(':videoId', $videoId);
	    $this->db->execute();
	}

////////////////////////////////////////////////////////////////////////////





	
} // end class














 ?>