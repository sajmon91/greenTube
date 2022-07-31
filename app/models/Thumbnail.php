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



	
} // end class














 ?>