<?php $this->view('inc/header'); ?>

<main class="content">

  <div class="listContent">

    <?php foreach($data as $video): ?>

      <div class="videoItem">
        <a href="video.html">
          <div class="videoThumbnail">
            <video muted class="videoPlay" poster="<?= URLROOT . "/" . $video->thumbPath; ?>">
              <source src="<?= URLROOT . "/" . $video->videoPath; ?>" type="video/mp4">
            </video>
            <div class="duration">
              <span><?= $video->duration; ?></span>
            </div>
          </div>
        </a>
        <div class="videoDetails">
          <img src="<?= URLROOT . $video->profilePic; ?>" alt="user image">
          <div class="videoInfo">
            <a href="video.html"><?= $video->title; ?></a>
            <p><?= $video->username; ?></p>
            <p><?= Formater::getFormattedNumber($video->views); ?> views &bull; <?= Formater::timeAgo($video->uploadDate); ?></p>
          </div>
        </div>
      </div>

    <?php endforeach; ?>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>