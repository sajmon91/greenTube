<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="videoContent">
    <div class="playVideo">
      <video controls autoplay>
        <source src="<?= URLROOT . '/' . $data['video']->filePath; ?>" type="video/mp4">
      </video>

      <div class="videoTags">
        <?php foreach($data['tags'] as $tag): ?>
          <a href="<?= URLROOT; ?>/tags/<?= $tag->tagName; ?>">#<?= $tag->tagName; ?></a>
        <?php endforeach; ?>
  
      </div>

      <div class="videoInfo">
        <h1><?= $data['video']->title; ?></h1>
        <div class="videoInfoBottom">
          <p class="viewCount"><?= Formater::numberFormat($data['video']->views); ?> Views &bull; <?= Formater::dateFormat($data['video']->uploadDate); ?></p>
          <div class="controls">
            <button data-videoid="<?= $data['video']->videoId; ?>" class="likeBtn videoLike" title="I like this">
              <?php if($data['wasLikedVideo']) : ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/like-active.png" alt="like button">
              <?php else: ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/like.png" alt="like button">
              <?php endif; ?>
              <span class="btnText"><?= Formater::numberFormat($data['likes']); ?></span>
            </button>

            <button data-videoid="<?= $data['video']->videoId; ?>" class="dislikeBtn videoDislike" title="I dislike this">
              <?php if($data['wasDislikedVideo']) : ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/dislike-active.png" alt="dislike button">
              <?php else: ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/dislike.png" alt="dislike button">
              <?php endif; ?>
              <span class="btnText"><?= Formater::numberFormat($data['dislikes']); ?></span>
            </button>
          </div>
        </div>
      </div>

      <hr>

      <div class="publisher">
        <a href="profile.html">
          <img class="profilePicture" src=" <?= URLROOT . $data['user']->profilePic; ?>" alt="user">
        </a>
        <div>
          <a href="profile.html">
            <p> <?= $data['user']->username; ?></p>
          </a>
          <span>100k Subscribers</span>
        </div>
        <button class="subscribeBtn">Subscribe</button>
      </div>

      <div class="videoDescription">
        <?= $data['video']->description; ?>
      </div>

      <hr>

      <?php if ($data['video']->comments) : ?>
        <div class="commentSection">
          <div class="commentHeader">
            <div class="commentCount">
              <p>22 Comments</p>
            </div>
            <div class="commentForm">
              <a href="profile.html">
                <?php if (isLoggedIn()) : ?>
                  <img class="profilePicture" src="<?= URLROOT . $_SESSION['profile_pic']; ?>" alt="user">
                <?php else: ?>
                  <img class="profilePicture" src="<?= URLROOT; ?>/assets/images/icons/user.png" alt="user">
                <?php endif; ?>
              </a>
              <textarea class="commentBody" placeholder="Add a comment..."></textarea>

              <button class="postComment">Comment</button>
            </div>
          </div>

          <div class="comments">

            <div class="commentWrapper">
              <a href="profile.html">
                <img class="profilePicture" src="assets/images/profilePictures/defaults/head_green_sea.png"
                  alt="user image">
              </a>
              <div class="comment">
                <h3><a href="profile.html">John Smith</a> <span> 2 days ago</span></h3>
                <div class="postedCommentBody">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate,
                  atque!</div>
                <div class="controls">
                  <button class="likeBtn" title="I like this">
                    <img src="<?= URLROOT; ?>/assets/images/icons/like-active.png" alt="like button">
                    <span class="btnText">5</span>
                  </button>

                  <button class="dislikeBtn" title="I dislike this">
                    <img src="<?= URLROOT; ?>/assets/images/icons/dislike.png" alt="dislike button">
                    <span class="btnText">2</span>
                  </button>

                  <button class="replyBtn">
                    <span class="btnText">Reply</span>
                  </button>

                  <button class="viewReplies">
                    <span class="btnText">View all 2 replies</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="commentWrapper">
              <a href="profile.html">
                <img class="profilePicture" src="assets/images/profilePictures/defaults/head_pumpkin.png"
                  alt="user image">
              </a>
              <div class="comment">
                <h3><a href="profile.html">John Smith</a> <span> 2 days ago</span></h3>
                <div class="postedCommentBody">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Cupiditate,Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium voluptates
                  repellendus, tempore aspernatur suscipit at.
                  atque!</div>
                <div class="controls">
                  <button class="likeBtn" title="I like this">
                    <img src="<?= URLROOT; ?>/assets/images/icons/like-active.png" alt="like button">
                    <span class="btnText">5</span>
                  </button>

                  <button class="dislikeBtn" title="I dislike this">
                    <img src="<?= URLROOT; ?>/assets/images/icons/dislike.png" alt="dislike button">
                    <span class="btnText">2</span>
                  </button>

                  <button class="replyBtn">
                    <span class="btnText">Reply</span>
                  </button>

                </div>
              </div>
            </div>

          </div>

        </div>

      <?php else: ?>

        <div class="commentsOff">
          <p>Comments are turned off.</p>
        </div>

      <?php endif; ?>

    </div>

    <aside class="suggestions">

      <?php foreach($data['catVideos'] as $catVideo) : ?>
        <div class="videoItem">
          <a href="<?= URLROOT; ?>/watch/<?= $catVideo->videoId; ?>">
            <div class="videoThumbnail">
              <video muted class="videoPlay" poster="<?= URLROOT . '/' . $catVideo->thumbPath; ?>">
                <source src="<?= URLROOT . '/' . $catVideo->videoPath; ?>" type="video/mp4">
              </video>
              <div class="duration">
                <span><?= $catVideo->duration; ?></span>
              </div>
            </div>
          </a>
          <div class="videoDetails">
            <a class="videoTitle" href="<?= URLROOT; ?>/watch/<?= $catVideo->videoId; ?>"><?= $catVideo->title; ?></a>
            <a class="videoChannel" href="profile.html"><?= $catVideo->username; ?></a>
            <p><?= Formater::getFormattedNumber($catVideo->views); ?> views &bull; <?= Formater::timeAgo($catVideo->uploadDate); ?></p>
          </div>
        </div>
      <?php endforeach; ?>

    </aside>
  </div>

  

</main>

 <?php $this->view('inc/footer'); ?>