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
              <span class="btnText"><?= $data['likes']; ?></span>
            </button>

            <button data-videoid="<?= $data['video']->videoId; ?>" class="dislikeBtn videoDislike" title="I dislike this">
              <?php if($data['wasDislikedVideo']) : ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/dislike-active.png" alt="dislike button">
              <?php else: ?>
                <img src="<?= URLROOT; ?>/assets/images/icons/dislike.png" alt="dislike button">
              <?php endif; ?>
              <span class="btnText"><?= $data['dislikes']; ?></span>
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
            <p><?= $data['user']->username; ?></p>
          </a>
          <span><?= Formater::getFormattedNumber($data['subsCount']); ?> Subscribers</span>
        </div>

        <?php if($data['isMyVideo']): ?>
          <p>edit video btn here</p>
        <?php else: ?>
          <button data-subId="<?= $data['user']->userId; ?>" class="subscribeBtn <?= (($data['isSubscribedTo']) ? 'unsubscribe' : 'subscribe'); ?>"><?= (($data['isSubscribedTo']) ? 'Subscribed' : 'Subscribe'); ?></button>
        <?php endif; ?>
      </div>

      <div class="videoDescription">
        <?= $data['video']->description; ?>
      </div>

      <hr>

      <!-- comment section -->

      <?php if ($data['video']->comments) : ?>
        <div class="commentSection">
          <div class="commentHeader">
            <div class="commentCount">
              <p><?= $data['totalComm']; ?> <?= ($data['totalComm'] > 1 ? 'Comments' : 'Comment'); ?></p>
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

              <button data-videoid="<?= $data['video']->videoId; ?>" class="postComment">Comment</button>
            </div>
          </div>

          <div class="comments">

            <?php foreach($data['comments'] as $comm) : ?>

              <div class="commentWrapper">
                <a href="profile.html">
                  <img class="profilePicture" src="<?= URLROOT . $comm['com']->profilePic; ?>"
                    alt="user image">
                </a>
                <div class="comment">
                  <h3><a href="profile.html"><?= $comm['com']->username; ?></a> <span> <?= Formater::timeAgo($comm['com']->datePosted); ?></span></h3>
                  <div class="postedCommentBody"><?= $comm['com']->body; ?></div>

                  <div class="controls">
                    <button data-commid="<?= $comm['com']->commentId; ?>" class="likeBtn commLikeBtn" title="I like this">
                      <?php if($comm['wasLiked']) : ?>
                        <img src="<?= URLROOT; ?>/assets/images/icons/like-active.png" alt="like button">
                      <?php else: ?>
                        <img src="<?= URLROOT; ?>/assets/images/icons/like.png" alt="like button">
                      <?php endif; ?>
                      <span class="btnText"><?= ($comm['likes'] == 0) ? '' : $comm['likes']; ?></span>
                    </button>

                    <button data-commid="<?= $comm['com']->commentId; ?>" class="dislikeBtn commDislikeBtn" title="I dislike this">
                      <?php if($comm['wasDisliked']) : ?>
                        <img src="<?= URLROOT; ?>/assets/images/icons/dislike-active.png" alt="dislike button">
                      <?php else: ?>
                        <img src="<?= URLROOT; ?>/assets/images/icons/dislike.png" alt="dislike button">
                      <?php endif; ?>
                      <span class="btnText"><?= ($comm['dislikes'] == 0) ? '' : $comm['dislikes']; ?></span>
                    </button>

                    <button class="replyBtn">
                      <span class="btnText">Reply</span>
                    </button>

                    <?php if ($comm['replies'] !== 0) :?>
                      <button data-commid="<?= $comm['com']->commentId; ?>" data-urlroot="<?= URLROOT; ?>" class="viewReplies">
                        <span class="btnText">View all <?= $comm['replies']; ?> replies</span>
                      </button>
                    <?php endif; ?>

                  </div>
<!-- ------------------------------------------------ -->
                  <div class="replyForm hidden">
                    <a href="profile.html">
                      <?php if (isLoggedIn()) : ?>
                        <img class="profilePicture" src="<?= URLROOT . $_SESSION['profile_pic']; ?>" alt="user">
                      <?php else: ?>
                        <img class="profilePicture" src="<?= URLROOT; ?>/assets/images/icons/user.png" alt="user">
                      <?php endif; ?>
                    </a>
                    <textarea class="replyCommentBody" placeholder="Add a comment..."></textarea>

                    <button class="cancelBtn">Cancel</button>
                    <button data-commid="<?= $comm['com']->commentId; ?>" data-videoid="<?= $data['video']->videoId; ?>" class="postReplyComment">Reply</button>
                  </div>

                </div>
              </div>

            <?php endforeach; ?>

          </div>

        </div>

      <?php else: ?>

        <div class="commentsOff">
          <p>Comments are turned off.</p>
        </div>

      <?php endif; ?>

    </div>

    <!-- side bar -->

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