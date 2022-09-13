<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="dashboardContent">

    <h2>Channel content</h2>

    <div class="dashboardTable">
      <input type="text" name="search" id="dashboardSearch" placeholder="Search...">

      <div style="overflow-x:auto;">
        <table class="table-sortable">
          <thead>
            <tr>
              <th>Video</th>
              <th>Visibility</th>
              <th class="sort" data-column='byDate'>Date</th>
              <th class="sort" data-column='byViews'>Views</th>
              <th>Comments</th>
              <th>Likes (Dislikes)</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach($data['videos'] as $video) : ?>

              <tr>
                <td>
                  <a href="<?= URLROOT . '/editVideos/' . $video['video']->videoId; ?>">
                    <div class="tableVideo">
                      <img src="<?= URLROOT . '/' . $video['video']->thumbPath; ?>" alt="thumbnails">
                      <div>
                        <p class="title"><?= $video['video']->title; ?></p>
                        <p class="description"><?= substr($video['video']->description, 0, 250); ?></p>
                      </div>
                    </div>
                  </a>
                </td>
                <td><?= ($video['video']->privacy) ? 'Private' : 'Public'; ?></td>
                <td><?= date("j.m.Y", strtotime($video['video']->uploadDate)); ?></td>
                <td><?= $video['video']->views; ?></td>
                <td><?= $video['comments']; ?></td>
                <td><?= $video['likes']; ?> (<?= $video['dislikes']; ?>)</td>
              </tr>

            <?php endforeach; ?>

          </tbody>

        </table>
      </div>

    </div>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>