<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="uploadEditVideoContent">

    <h2>Edit Video</h2>

    <div class="editVideo">

      <video class='videoPlayer' controls>
        <source src='<?= URLROOT . '/' . $data['video']->filePath; ?>' type='video/mp4'>
      </video>

      <div class='thumbnailItemContainer'>

        <?php foreach($data['videoThumbnails'] as $thumb): ?>

          <div data-videoid="<?= $thumb->videoId; ?>" data-thumbid="<?= $thumb->id; ?>" class='thumbnailItem <?= ($thumb->selected == 1) ? 'selected' : ''; ?>'>
            <img src='<?= URLROOT . '/' . $thumb->filePath; ?>'>
          </div>

        <?php endforeach; ?>

      </div>
    </div>

    <div class="uploadWrapper">

      <form class="videoEditForm" action="#">
        <div class="uploadInput">
          <label class="uploadLabel" for="title">Title</label>
          <input name="videoTitle" type="text" id="title" value="<?= $data['video']->title; ?>">
        </div>

        <div class="uploadInput">
          <label class="uploadLabel" for="description">Description</label>
          <textarea name="videoDesc" id="description"><?= $data['video']->description; ?></textarea>
        </div>

        <div class="uploadInput">
          <label class="uploadLabel" for="category">Category</label>
          <select class="uploadSelect" id="category" name="videoCat">
            <?php foreach($data['categories'] as $cat) : ?>

              <option <?= ($data['video']->category == $cat->categoryId) ? 'selected' : ''; ?> value="<?= $cat->categoryId; ?>"><?= $cat->categoryName; ?></option>

            <?php endforeach; ?>
          </select>
        </div>

        <div class="uploadInput">
          <label class="uploadLabel" for="privacy">Privacy</label>
          <select class="uploadSelect" id="privacy" name="videoPri">
            <option <?= ($data['video']->privacy == 1) ? 'selected' : ''; ?> value="1">Private</option>
            <option <?= ($data['video']->privacy == 0) ? 'selected' : ''; ?> value="0">Public</option>
          </select>
        </div>

        <div class="uploadInput">
          <p class="uploadPara">Comments</p>
          <div class="comments">
            <input type="radio" name="comments" id="on" value="1" <?= ($data['video']->comments == 1) ? 'checked' : ''; ?>>
            <label for="on">On</label>
            <input type="radio" name="comments" id="off" value="0" <?= ($data['video']->comments == 0) ? 'checked' : ''; ?>>
            <label for="off">Off</label>
          </div>
        </div>

        <div class="uploadInput">
          <label class="uploadLabel" for="tags">Tags <span>(optional)</span></label>
          <div class="uploadTags">
            <input name="videoTags" type="text" id="tags" value="<?= $data['videoTags']; ?>">
            <p>(Separate with coma)</p>
          </div>

        </div>

        <input type="hidden" name="videoId" value="<?= $data['video']->videoId; ?>">
        <button class="formBtn saveVideoInfo">Save</button>
      </form>
    </div>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>