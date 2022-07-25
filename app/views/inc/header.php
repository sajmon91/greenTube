<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/logo.png">
  <link rel="stylesheet" href="assets/scss/style.css">
  <title><?php echo $data['title'] ?? SITENAME; ?></title>
</head>

<body>

  <nav class="nav">

    <div class="nav__left">
      <button class="menuIcon">
        <img src="assets/images/icons/menu.png" alt="menu icon">
      </button>
      <a href="index.html" class="logo">
        <img src="assets/images/icons/logo.png" alt="logo">
        <h1>Green <span>Tube</span></h1>
      </a>
    </div>

    <div class="nav__center">
      <form action="#" method="POST">
        <input type="text" class="searchBar" name="term" placeholder="Search...">
        <button class="searchButton">
          <img src="assets/images/icons/search.png" alt="search icon">
        </button>
      </form>
    </div>

    <div class="nav__right">

      <?php if(isLoggedIn()): ?>

        <a href="upload.html" title="Upload video" class="uploadBtn">
          <img class="upload" src="assets/images/icons/upload-icon.png" alt="upload icon">
        </a>

        <div class="dropdown">
          <button class="dropBtn" title='username'>
            <img class="userIcon" src='assets/images/profilePictures/defaults/head_alizarin.png' class='profilePicture'>
          </button>

          <div class="dropdownContent">
            <a href="profile.html"><img src="assets/images/icons/user-white.png" alt="user"> Profile</a>
            <a href="dashboard.html"><img src="assets/images/icons/dashboard.png" alt="dashboard">Dashboard</a>
            <a href="settings.html"><img src="assets/images/icons/settings.png" alt="settings">Settings</a>
            <a href="#"><img src="assets/images/icons/logout.png" alt="logout">Logout</a>
          </div>
        </div>

      <?php else: ?>

        <a class="signInBtn" href="<?=URLROOT;?>/users/signin">
          <img src="assets/images/icons/user.png">Sign In
        </a>

      <?php endif; ?>

    </div>

  </nav>

  <nav class="mobNav">
    <ul class="mobNavList">
      <li class="sidebarListItem">
        <a href="index.html" class="sidebarLink">
          <img src="assets/images/icons/home.png" alt="Home icon">
          <p>Home</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="trending.html" class="sidebarLink">
          <img src="assets/images/icons/trending.png" alt="trending icon">
          <p>Trending</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="subscriptions.html" class="sidebarLink">
          <img src="assets/images/icons/subscribe.png" alt="subscribe icon">
          <p>Subscriptions</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="likedVideos.html" class="sidebarLink">
          <img src="assets/images/icons/like.png" alt="like video icon">
          <p>Liked Videos</p>
        </a>
      </li>
    </ul>
  </nav>


  <div class="container">

    <aside class="sidebar">

      <div class="sidebar__top">
        <ul class="sidebarList">

          <li class="sidebarListItem">
            <a href="index.html" class="sidebarLink" title="Home">
              <img src="assets/images/icons/home.png" alt="Home icon">
              <p class="hiddenSidebar">Home</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="trending.html" class="sidebarLink" title="Trending">
              <img src="assets/images/icons/trending.png" alt="trending icon">
              <p class="hiddenSidebar">Trending</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="subscriptions.html" class="sidebarLink" title="Subscriptions">
              <img src="assets/images/icons/subscribe.png" alt="subscribe icon">
              <p class="hiddenSidebar">Subscriptions</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="likedVideos.html" class="sidebarLink" title="Liked Videos">
              <img src="assets/images/icons/like.png" alt="like video icon">
              <p class="hiddenSidebar">Liked Videos</p>
            </a>
          </li>

        </ul>
      </div>

      <?php if(isLoggedIn()): ?>

        <hr>

        <div class="sidebar__middle">
          <h3 class="hiddenSidebar">subscribed</h3>
          <ul class="sidebarList">

            <li class="sidebarListItem">
              <a href="profile.html" class="sidebarLink" title="username">
                <img class="subsIcon" src="assets/images/profilePictures/defaults/head_carrot.png" alt="user icon">
                <p class="hiddenSidebar">chanel name</p>
              </a>
            </li>

            <li class="sidebarListItem">
              <a href="profile.html" class="sidebarLink" title="username">
                <img class="subsIcon" src="assets/images/profilePictures/defaults/head_amethyst.png" alt="user icon">
                <p class="hiddenSidebar">username</p>
              </a>
            </li>
          </ul>
        </div>

        <div class="sidebar__bottom">
          <ul class="sidebarList">
            <li class="sidebarListItem">
              <a href="settings.html" class="sidebarLink" title="Settings">
                <img src="assets/images/icons/settings.png" alt="settings icon">
                <p class="hiddenSidebar">Settings</p>
              </a>
            </li>

            <li class="sidebarListItem">
              <a href="#" class="sidebarLink" title="Logout">
                <img src="assets/images/icons/logout.png" alt="logout icon">
                <p class="hiddenSidebar">Logout</p>
              </a>
            </li>
          </ul>
        </div>

      <?php endif; ?>

    </aside>