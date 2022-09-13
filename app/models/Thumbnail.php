<?php 

/**
 * Thumbnail model
 */
class Thumbnail
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  	public function __construct()
	{
		$this->db = new Database;
	}

////////////////////////////////////////////////////////////////////////////

	public function insertThumbnails($videoId, $filePath, $selected)
	{
		$this->db->query("INSERT INTO thumbnails (videoId, filePath, selected) VALUES (:videoId, :filePath, :selected)");

		// bind value
		$this->db->bind(':videoId', $videoId);
		$this->db->bind(':filePath', $filePath);
		$this->db->bind(':selected', $selected);

		return $this->db->execute();
	}

////////////////////////////////////////////////////////////////////////////

	public function getVideoThumbnails($videoId)
	{
	    $this->db->query("SELECT * FROM thumbnails WHERE videoId = :videoId");

	    $this->db->bind(':videoId', $videoId);

	    return $this->db->resultSet();
	}

////////////////////////////////////////////////////////////////////////////

	public function update($videoId, $thumbId)
	{
	    $this->db->query("UPDATE thumbnails SET selected = 0 WHERE videoId = :videoId");
	    $this->db->bind(':videoId', $videoId);
	    $this->db->execute();

	    $this->db->query("UPDATE thumbnails SET selected = 1 WHERE id = :thumbId");
	    $this->db->bind(':thumbId', $thumbId);

	    return ($this->db->execute()) ? true : false;
	}

////////////////////////////////////////////////////////////////////////////



	
} // end class














 ?>