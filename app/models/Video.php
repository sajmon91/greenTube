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

	public function getVideoInfoById($videoId)
	{
	    $this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username, u.profilePic FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.privacy = 0 AND v.videoId = :videoId");

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

	public function getTrendingVideos()
	{
	    $this->db->query("SELECT v.videoId, v.title, v.description, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.uploadDate >= NOW() - INTERVAL 14 DAY AND v.privacy = 0  ORDER BY v.views DESC LIMIT 20");

	    return $this->db->resultSet();
	}

//////////////////////////////////////////////////////////////////////////

	public function getSubscriptionsVideos($subsArr)
	{
		if (sizeof($subsArr) > 0) {
			$condition = '';
			$i = 0;

			while ($i < sizeof($subsArr)) {
				if ($i === 0) {
					$condition .= "WHERE (v.uploadedBy = ? AND v.privacy = 0)";
				}else{
					$condition .= " OR (v.uploadedBy = ? AND v.privacy = 0)";
				}
				$i++;
			}

			$this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath, u.username, u.profilePic FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId $condition ORDER BY v.uploadDate DESC LIMIT 30");

			$i = 1;

			foreach($subsArr as $sub){
				$this->db->bind($i, $sub->userId);
				$i++;
			}

			return $this->db->resultSet();
		}
	    
	}

//////////////////////////////////////////////////////////////////////////

	public function getLikedVideo($videoId)
	{
	    $this->db->query("SELECT v.videoId, v.title, v.duration, t.filePath as thumbPath, u.username, u.userId FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 inner join users as u on v.uploadedBy = u.userId WHERE v.privacy = 0 AND v.videoId = :videoId");

	    $this->db->bind(':videoId', $videoId);

	    return $this->db->single();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideosTotalViews($userId)
	{
	    $this->db->query("SELECT SUM(views) as vidViews FROM videos WHERE uploadedBy = :uploadedBy");

	    $this->db->bind(':uploadedBy', $userId);

	    return $this->db->single();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideosCount($userId)
	{
	    $this->db->query("SELECT COUNT(videoId) as videoCount FROM videos WHERE uploadedBy = :uploadedBy");

	    $this->db->bind(':uploadedBy', $userId);

	    return $this->db->single();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideosByUser($userId)
	{
	    $this->db->query("SELECT v.videoId, v.title, v.filePath as videoPath, v.uploadDate, v.views, v.duration, t.filePath as thumbPath FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 WHERE v.privacy = 0 AND v.uploadedBy = :userId ORDER BY v.videoId DESC");

	    $this->db->bind(':userId', $userId);

	    return $this->db->resultSet();
	}

//////////////////////////////////////////////////////////////////////////

	public function getVideosInDashboard($userId)
	{
	    $this->db->query("SELECT v.videoId, v.title,v.description, v.privacy, v.uploadDate, v.views, t.filePath as thumbPath FROM videos as v inner join thumbnails as t on v.videoId = t.videoId and t.selected = 1 WHERE v.uploadedBy = :userId ORDER BY v.videoId DESC");

	    $this->db->bind(':userId', $userId);

	    return $this->db->resultSet();
	}

//////////////////////////////////////////////////////////////////////////

	public function updateVideoInfo($data)
	{
	    $this->db->query("UPDATE videos SET title = :title, description = :description, category = :category, privacy = :privacy, comments = :comments WHERE videoId = :videoId");

	    $this->db->bind(':title', $data['videoTitle']);
	    $this->db->bind(':description', $data['videoDesc']);
	    $this->db->bind(':category', $data['videoCat']);
	    $this->db->bind(':privacy', $data['videoPri']);
	    $this->db->bind(':comments', $data['videoComm']);
	    $this->db->bind(':videoId', $data['videoId']);

	    return ($this->db->execute()) ? true : false;
	}

//////////////////////////////////////////////////////////////////////////


} // end class














 ?>