<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=URLROOT;?>/assets/images/icons/logo.png">
  <link rel="stylesheet" href="<?=URLROOT;?>/assets/scss/style.css">
  <title>Sign In</title>
</head>

<body>

  <div class="signInLoginContainer">
    <div class="signInLoginWrapper">

      <div class="header">
        <div>
          <img src="<?=URLROOT;?>/assets/images/icons/logo.png" alt="GreenTube Logo">
          <p>Green <span>Tube</span></p>
        </div>
        <h3>Sign In</h3>
        <p>to continue to Green Tube</p>
        <p class="successText"><?php displayMessage(); ?></p>
      </div>

      <div class="formContainer">
        <form action="#" method="POST">

          <div class="formInput">
            <input type="text" name="username" value="<?= $data['username']; ?>" required>
            <label for="username" class="labelName">
              <span class="contentName">Username</span>
            </label>
          </div>
          <span class=error><?= $data['usernameErr']; ?></span>


          <div class="formInput">
            <input type="password" name="password" required>
            <label for="password" class="labelName">
              <span class="contentName">Password</span>
            </label>
          </div>
          <span class=error><?= $data['passwordErr']; ?></span>

          <button class="formBtn">Submit</button>

        </form>
      </div>

      <a href="<?=URLROOT;?>/users/signup">Do not have an account yet? Sign up here!</a>
    </div>
  </div>

  <script src="<?=URLROOT;?>/assets/js/main.js"></script>
</body>

</html>