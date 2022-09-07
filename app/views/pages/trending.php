<?php $this->view('inc/header', $data); ?>

<main class="content">

   <div class="trendingContent">

      <?php if($data['videos']): ?>

        <h2>Trending Videos</h2>

        <?php foreach ($data['videos'] as $video) :?>

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
              <a class="videoTitle" href="<?= URLROOT; ?>/watch/<?= $video->videoId; ?>"><?= $video->title; ?></a>
              <p><a href="<?= URLROOT; ?>/profiles/<?= $video->username; ?>"><?= $video->username; ?></a> - <?= Formater::getFormattedNumber($video->views); ?> views &bull; <?= Formater::timeAgo($video->uploadDate); ?></p>
              <p class="description"><?= substr($video->description,0,250) . (strlen($video->description) > 250 ? '...' : ''); ?></p>
            </div>
          </div>

        <?php endforeach; ?>

      <?php else: ?>
        <h2 class="noTrending">No trending videos to show</h2>
      <?php endif; ?>
    </div>

</main>

 <?php $this->view('inc/footer'); ?>