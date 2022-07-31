<?php $this->view('inc/header', $data); ?>

	<main class="content">

      <div class="uploadEditVideoContent">

        <h2>Upload Video</h2>


        <div class="uploadWrapper">

        	<form class="videoUploadForm" action="#">
	          <div class="uploadInput">
	            <label class="uploadLabel" for="inputFile">Your file</label>
	            <input type="file" id="inputFile" name="fileInput" required>
	          </div>

	          <div class="uploadInput">
	            <label class="uploadLabel" for="title">Title</label>
	            <input type="text" id="title" name="videoTitle" required>
	          </div>

	          <div class="uploadInput">
	            <label class="uploadLabel" for="description">Description</label>
	            <textarea id="description" name="videoDesc"></textarea>
	          </div>

	          <div class="uploadInput">
	            <label class="uploadLabel" for="category">Category</label>
	            <select class="uploadSelect" id="category" name="videoCat">

	            	<?php foreach ($data['categories'] as $category): ?>
	              		<option value="<?= $category->categoryId; ?>"><?= $category->categoryName; ?></option>
	          		<?php endforeach;?>

	            </select>
	          </div>

	          <div class="uploadInput">
	            <label class="uploadLabel" for="privacy">Privacy</label>
	            <select class="uploadSelect" id="privacy" name="videoPrivacy">
	              <option value="1">Private</option>
	              <option value="0">Public</option>
	            </select>
	          </div>

	          <div class="uploadInput">
	            <p class="uploadPara">Comments</p>
	            <div class="comments">
	              <input type="radio" name="comments" id="on" value="1" checked>
	              <label for="on">On</label>
	              <input type="radio" name="comments" id="off" value="0">
	              <label for="off">Off</label>
	            </div>
	          </div>

	          <div class="uploadInput">
	            <label class="uploadLabel" for="tags">Tags <span>(optional)</span></label>
	            <div class="uploadTags">
	              <input type="text" id="tags" name="videoTags">
	              <p>(Separate with coma)</p>
	            </div>

	          </div>

	          <button class="formBtn uploadVideoButton">Upload</button>
          </form>
        </div>

      </div>

    </main>

<?php $this->view('inc/footer'); ?>