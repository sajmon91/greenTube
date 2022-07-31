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



	
} // end class














 ?>