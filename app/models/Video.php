<?php 

/**
 * Video model
 */
class Video
{
	private $db;

////////////////////////////////////////////////////////////////////////////

  	public function __construct()
	{
		$this->db = new Database;
	}

////////////////////////////////////////////////////////////////////////////

	public function insertVideoData($data, $filePath)
	{
	  	$uploadDate = date("Y-m-d H:i:s");
	     
	    $this->db->query("INSERT INTO videos (uploadedBy, title, description, category, privacy, comments, filePath, uploadDate) VALUES (:uploadedBy, :title, :description, :category, :privacy, :comments, :filePath, :uploadDate)");

	    // bind value
	    $this->db->bind(':uploadedBy', $_SESSION['user_id']);
	    $this->db->bind(':title', $data['videoTitle']);
	    $this->db->bind(':description', $data['videoDesc']);
	    $this->db->bind(':category', $data['videoCat']);
	    $this->db->bind(':privacy', $data['videoPriv']);
	    $this->db->bind(':comments', $data['videoComm']);
	    $this->db->bind(':filePath', $filePath);
	    $this->db->bind(':uploadDate', $uploadDate);

	    // execute
	    if ($this->db->execute()) {
	      return $this->db->lastId();
	    }else{
	      return false;
	    }
	}

////////////////////////////////////////////////////////////////////////////

	public function updateDuration($duration, $videoId)
	{
	    $this->db->query("UPDATE videos SET duration = :duration WHERE videoId = :videoId");

	    // bind value
	    $this->db->bind(':duration', $duration);
	    $this->db->bind(':videoId', $videoId);

	    $this->db->execute();
	}

////////////////////////////////////////////////////////////////////////////



	
} // end class














 ?>