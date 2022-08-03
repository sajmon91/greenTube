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

	public function getRandomVideos()
	{
	    $this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username, u.profilePic FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.privacy = 0  ORDER BY RAND() LIMIT 20");

	    return $this->db->resultSet();
	}

////////////////////////////////////////////////////////////////////////////

	public function getVideosByTag($videoId)
	{
	    $this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username, u.profilePic FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.privacy = 0 AND v.videoId = :videoId ORDER BY RAND() LIMIT 20");

	    $this->db->bind(':videoId', $videoId);

	    return $this->db->single();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideoById($id)
	{
	    $this->db->query("SELECT * FROM videos WHERE videoId = :videoId");

	    $this->db->bind(':videoId', $id);

	    return $this->db->single();
	}
	
//////////////////////////////////////////////////////////////////////////

	public function updateViews($id)
	{
	    $this->db->query("UPDATE videos SET views = views + 1 WHERE videoId = :videoId");

	    $this->db->bind(':videoId', $id);

	    $this->db->execute();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideosByCategory($catId, $videoId)
	{
	    $this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.privacy = 0 AND v.category = :catId AND v.videoId != :videoId ORDER BY RAND() LIMIT 20");

	    $this->db->bind(':catId', $catId);
	    $this->db->bind(':videoId', $videoId);

	    return $this->db->resultSet();
	}

//////////////////////////////////////////////////////////////////////////











} // end class














 ?>