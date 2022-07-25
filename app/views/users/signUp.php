<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=URLROOT;?>/assets/images/icons/logo.png">
  <link rel="stylesheet" href="<?=URLROOT;?>/assets/scss/style.css">
  <title>Sign Up</title>
</head>

<body>

  <div class="signInLoginContainer">
    <div class="signInLoginWrapper">

      <div class="header">
        <div>
          <img src="<?=URLROOT;?>/assets/images/icons/logo.png" alt="GreenTube Logo">
          <p>Green <span>Tube</span></p>
        </div>
        <h3>Sign Up</h3>
        <p>to continue to Green Tube</p>
      </div>

      <div class="formContainer">
        <form action="#" method="POST">

          <div class="formInput">
            <input type="text" name="firstName" value="<?= $data['firstName']; ?>" required>
            <label for="firstName" class="labelName">
              <span class="contentName">First Name</span>
            </label>
          </div>
          <span class=error><?= $data['firstNameErr']; ?></span>

          <div class="formInput">
            <input type="text" name="lastName" value="<?= $data['lastName']; ?>" required>
            <label for="lastName" class="labelName">
              <span class="contentName">Last Name</span>
            </label>
          </div>
          <span class=error><?= $data['lastNameErr']; ?></span>

          <div class="formInput">
            <input type="text" name="username" value="<?= $data['username']; ?>" required>
            <label for="username" class="labelName">
              <span class="contentName">Username</span>
            </label>
          </div>
          <span class=error><?= $data['usernameErr']; ?></span>

          <div class="formInput">
            <input type="email" name="email" value="<?= $data['email']; ?>" required>
            <label for="email" class="labelName">
              <span class="contentName">Email</span>
            </label>
          </div>
          <span class=error><?= $data['emailErr']; ?></span>

          <div class="formInput">
            <input type="email" name="email2" value="<?= $data['email2']; ?>" required>
            <label for="email2" class="labelName">
              <span class="contentName">Confirm Email</span>
            </label>
          </div>
          <span class=error><?= $data['email2Err']; ?></span>


          <div class="formInput">
            <input type="password" name="password" required>
            <label for="password" class="labelName">
              <span class="contentName">Password</span>
            </label>
          </div>
          <span class=error><?= $data['passwordErr']; ?></span>

          <div class="formInput">
            <input type="password" name="password2" required>
            <label for="password2" class="labelName">
              <span class="contentName">Confirm Password</span>
            </label>
          </div>
          <span class=error><?= $data['password2Err']; ?></span>

          <button class="formBtn">Submit</button>

        </form>
      </div>

      <a href="<?=URLROOT;?>/users/signin">Already have an account? Sign in here!</a>
    </div>
  </div>


  <script src="<?=URLROOT;?>/assets/js/main.js"></script>
</body>

</html>