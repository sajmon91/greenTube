<?php $this->view('inc/header', $data); ?>

<main class="content">

  <div class="settingsContent">

    <div class="settingsContainer">

      <div class="formSection">

        <h3>Profile Image</h3>
        <img class="imgPro" src="<?= URLROOT . $data['userData']->profilePic; ?>" alt="img">

        <div>
          <input hidden type="file" name="profileImg" id="profileImg" class="updateImage">
          <label for="profileImg" class="inputFile">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
              <path
                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
            </svg>
            <span>Browse&hellip;</span>
          </label>
        </div>

        <button class="formBtn saveProfileImg">Save</button>
      </div>

      <div class="formSection">

        <h3>User Details</h3>

        <input class="formInput" id="fn" type="text" placeholder="First Name" value="<?= $data['userData']->firstName; ?>">
        <input class="formInput" id="ln" type="text" placeholder="Last Name" value="<?= $data['userData']->lastName; ?>">
        <input class="formInput" id="em" type="email" placeholder="Email" value="<?= $data['userData']->email; ?>">
        <input class="formInput" id="un" type="text" placeholder="Username" value="<?= $data['userData']->username; ?>">

        <button class="formBtn saveUserDetails">Save</button>
      </div>

      <div class="formSection">

        <h3>Update Password</h3>

        <input class="formInput" type="password" placeholder="Old Password">
        <input class="formInput" type="password" placeholder="New Password">
        <input class="formInput" type="password" placeholder="Confirm new password">

        <button class="formBtn">Save</button>
      </div>

      <div class="formSection">
        <h3>Channel Cover Image</h3>
        <img class="imgCover" src="<?= URLROOT . $data['userData']->coverPic; ?>" alt="img">

        <div>
          <input hidden type="file" name="coverImg" id="coverImg" class="updateImage">
          <label for="coverImg" class="inputFile">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
              <path
                d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
            </svg>
            <span>Browse&hellip;</span>
          </label>
        </div>

        <button class="formBtn">Save</button>
      </div>

      <div class="formSection">

        <h3>Channel Description</h3>

        <textarea class="formInput"><?= $data['userData']->channelDesc; ?></textarea>

        <button class="formBtn">Save</button>
      </div>

    </div>

  </div>

</main>

 <?php $this->view('inc/footer'); ?>