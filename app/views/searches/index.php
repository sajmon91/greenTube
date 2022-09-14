<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="trendingContent searchContent">

    <div class="searchHeader">
      <h3><?= count($data['videos']); ?> results found</h3>
      <div>
        <span>Order by: </span>
        <a href="<?= URLROOT . '/searches/' . $data['term'] . '/uploadDate'; ?>">Upload date</a>
        <a href="<?= URLROOT . '/searches/' . $data['term'] . '/views'; ?>">Most viewed</a>
      </div>
    </div>

    <?php foreach($data['videos'] as $video): ?>

      <div class="videoItem">
        <div class="videoThumbnail">
          <a href="<?= URLROOT; ?>/watch/<?= $video->videoId; ?>">
            <video muted class="videoPlay" poster="<?= URLROOT . '/' . $video->thumbPath; ?>">
              <source src="<?= URLROOT . '/' . $video->videoPath; ?>" type="video/mp4">
            </video>
            <div class="duration">
              <span><?= $video->duration; ?></span>
            </div>
          </a>
        </div>
        <div class="videoDetails">
          <a title="<?= $video->title; ?>" class="videoTitle" href="<?= URLROOT; ?>/watch/<?= $video->videoId; ?>"><?= $video->title; ?></a>
          <p><a title="<?= $video->username; ?>" href="<?= URLROOT; ?>/profiles/<?= $video->username; ?>"><?= $video->username; ?></a> - <?= Formater::getFormattedNumber($video->views); ?> views &bull; <?= Formater::timeAgo($video->uploadDate); ?></p>
          <p class="description"><?= substr($video->description,0,250) . (strlen($video->description) > 250 ? '...' : ''); ?></p>
        </div>
      </div>

    <?php endforeach; ?>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>