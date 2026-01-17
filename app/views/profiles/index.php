<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="profileContent">

    <div class="profile">
      <img src="<?= URLROOT . $data['userData']->coverPic; ?>" alt="cover photo" class="profileCover">

      <div class="profileInfo">
        <div class="profileItem">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 469.33 469.33" fill="#fff">
            <path
              d="M320 213.33c35.3 0 63.79-28.69 63.79-64 0-35.3-28.48-64-63.79-64-35.3 0-64 28.7-64 64 0 35.31 28.7 64 64 64zM149.33 213.33c35.31 0 63.79-28.69 63.79-64 0-35.3-28.48-64-63.79-64-35.3 0-64 28.7-64 64 0 35.31 28.7 64 64 64zM149.33 256C99.52 256 0 280.96 0 330.67V384h298.67v-53.33c0-49.71-99.52-74.67-149.34-74.67zM320 256c-6.19 0-13.12.43-20.59 1.17 24.75 17.82 41.92 41.82 41.92 73.5V384h128v-53.33c0-49.71-99.52-74.67-149.33-74.67z" />
          </svg>
          <?= Formater::getFormattedNumber($data['subsCount']); ?>
        </div>
        <div class="profileItem">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 469.33 469.33">
            <path d="M234.67 170.67c-35.31 0-64 28.69-64 64s28.69 64 64 64 64-28.7 64-64-28.7-64-64-64z" />
            <path
              d="M234.67 74.67C128 74.67 36.9 141 0 234.67c36.9 93.65 128 160 234.67 160 106.77 0 197.76-66.35 234.66-160-36.9-93.66-127.89-160-234.66-160zm0 266.66c-58.88 0-106.67-47.78-106.67-106.66S175.79 128 234.67 128s106.66 47.79 106.66 106.67-47.78 106.66-106.66 106.66z" />
          </svg>
          <?= Formater::getFormattedNumber($data['videosViews']); ?>
        </div>
        <div class="profileItem">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 475.43 475.43">
            <path
              d="M306.9 164.57l78.9-86.2a7.83 7.83 0 001.56-8.36 8.36 8.36 0 00-7.3-4.7h-253.4s-3.13 0-3.13.52v-9.4a26.12 26.12 0 0021.94-27.7A28.73 28.73 0 00117.26 0a29.78 29.78 0 00-29.78 28.73 30.82 30.82 0 0020.37 27.7v411.16a7.84 7.84 0 0015.68 0V263.84h256.52c3.2.2 6.17-1.7 7.31-4.7a8.36 8.36 0 00-1.56-8.36l-78.9-86.2z" />
          </svg>
          <?= date("M j", strtotime($data['userData']->signUpDate)); ?>
        </div>
        <div class="profileItem">
          <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 411.14 411.14">
            <path
              d="M350.2 54.53H61.45C27.64 54.53 0 82.18 0 115.97v179.2c0 33.8 27.65 61.44 61.44 61.44H349.7c33.79 0 61.44-27.65 61.44-61.44v-179.2c.5-33.8-27.14-61.44-60.93-61.44zM287.75 210.7a11.96 11.96 0 01-3.58 3.59l-119.3 70.65a9.93 9.93 0 01-13.82-3.58 8.65 8.65 0 01-1.54-5.12V134.92c0-5.64 4.61-10.24 10.24-10.24 1.54 0 3.59.5 5.12 1.53l119.3 70.66c4.6 3.07 6.66 9.21 3.58 13.82z" />
          </svg>
          <?= Formater::getFormattedNumber($data['videosCount']); ?>
        </div>
      </div>
      <div class="profileMenu">
        <div class="profileAvatar">
          <img class="profileImg" src="<?= URLROOT . $data['userData']->profilePic; ?>" alt="profile image">
          <div class="profileName"><?= $data['userData']->firstName . ' ' . $data['userData']->lastName; ?></div>
        </div>
        <div class="menuItems">
          <button data-tab-target="#videos" class="profileMenuLink active">Videos</button>
          <button data-tab-target="#about" class="profileMenuLink">About</button>
        </div>


        <div class="subsButton">
          <button class="follow"><?= Formater::numberFormat($data['subsCount']); ?></button>

          <?php if (!$data['isMyProfile']): ?>
            <button data-subId="<?= $data['userData']->userId; ?>" class="follow subscribeBtn <?= (($data['isSubscribedTo']) ? 'unsubscribe' : 'subscribe'); ?>"><?= (($data['isSubscribedTo']) ? 'Subscribed' : 'Subscribe'); ?></button>
          <?php else: ?>
            <button class="follow subs">Subscribers</button>
          <?php endif; ?>
        </div>


      </div>
    </div>

    <div class="tabContent">

      <div id="videos" data-tab-content class="active">

        <div class="tabVideos">

          <?php foreach ($data['videos'] as $video) : ?>

            <div class="videoItem" data-video-on-hover="not-active" data-video-src="<?= URLROOT . '/' . $video->videoPath; ?>">
              <a href="<?= URLROOT . '/watch/' . $video->videoId; ?>">
                <div class="videoThumbnail">
                  <video muted playsinline webkit-playsinline class="videoPlay" poster="<?= URLROOT . '/' . $video->thumbPath; ?>"></video>
                  <div class="duration">
                    <span><?= $video->duration; ?></span>
                  </div>
                </div>
              </a>
              <div class="videoDetails">
                <div class="videoInfo">
                  <a href="<?= URLROOT . '/watch/' . $video->videoId; ?>"><?= $video->title; ?></a>
                  <p><?= Formater::getFormattedNumber($video->views); ?> views &bull; <?= Formater::timeAgo($video->uploadDate); ?></p>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>

      </div>

      <div id="about" data-tab-content>
        <div class="tabAbout">

          <?php if ($data['userData']->channelDesc): ?>
            <div class="tabDesc">
              <h3>Description</h3>
              <p><?= $data['userData']->channelDesc; ?></p>
            </div>
          <?php endif; ?>

          <div class="tabDetails">
            <h3>Details</h3>
            <div class="values">
              <span>Name: <?= $data['userData']->firstName . ' ' . $data['userData']->lastName; ?></span>
              <span>Username: <?= $data['userData']->username; ?></span>
              <span>Subscribers: <?= Formater::numberFormat($data['subsCount']); ?></span>
              <span>Total views: <?= Formater::numberFormat($data['videosViews']); ?></span>
              <span>Total videos: <?= Formater::numberFormat($data['videosCount']); ?></span>
              <span>Sign up date: <?= Formater::dateFormat($data['userData']->signUpDate); ?></span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</main>

<?php $this->view('inc/footer'); ?>