<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="likedVideosContent">

    <div class="left">
      <img src="<?= URLROOT; ?>/assets/images/icons/liked-videos.png" alt="liked videos image">
      <div>
        <h3>Liked videos</h3>
        <p><?= $data['totalVideos']; ?> videos</p>
      </div>

    </div>

    <div class="right">

      <?php 
        $i = 1;
        foreach($data['videos'] as $video):
      ?>
        <div class="videoItem">
          <div class="number">
            <p><?= $i; ?></p>
          </div>
          <a href="<?= URLROOT; ?>/watch/<?= $video->videoId; ?>">
            <div class="videoThumbnail">
              <img class="thumbnail" src="<?= URLROOT . '/' . $video->thumbPath; ?>" alt="thumbnail">
              <div class="duration">
                <span><?= $video->duration; ?></span>
              </div>
            </div>
          </a>
          <div class="videoDetails">
            <a class="videoTitle" href="<?= URLROOT; ?>/watch/<?= $video->videoId; ?>"><?= $video->title; ?></a>
            <a title="<?= $video->username; ?>" class="channelName" href="<?= URLROOT; ?>/profiles/<?= $video->username; ?>"><?= $video->username; ?></a>
          </div>
        </div>

      <?php 
        $i++; 
        endforeach; 
      ?>

    </div>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>