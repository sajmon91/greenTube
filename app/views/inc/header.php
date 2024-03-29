<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= URLROOT; ?>/assets/images/icons/logo.png">
  <link rel="stylesheet" href="<?= URLROOT; ?>/assets/scss/style.css">
  <title><?php echo $data['title'] ?? SITENAME; ?></title>
</head>

<body>

  <nav class="nav">

    <div class="nav__left">
      <button class="menuIcon">
        <img src="<?= URLROOT; ?>/assets/images/icons/menu.png" alt="menu icon">
      </button>
      <a href="<?= URLROOT; ?>" class="logo">
        <img src="<?= URLROOT; ?>/assets/images/icons/logo.png" alt="logo">
        <h1>Green <span>Tube</span></h1>
      </a>
    </div>

    <div class="nav__center">
      <form action="<?= URLROOT . '/searches/'?>" method="POST">
        <input type="text" class="searchBar" name="term" placeholder="Search...">
        <button class="searchButton">
          <img src="<?= URLROOT; ?>/assets/images/icons/search.png" alt="search icon">
        </button>
      </form>
    </div>

    <div class="nav__right">

      <?php if(isLoggedIn()): ?>

        <a href="<?=URLROOT;?>/VideosUploads/" title="Upload video" class="uploadBtn">
          <img class="upload" src="<?= URLROOT; ?>/assets/images/icons/upload-icon.png" alt="upload icon">
        </a>

        <div class="dropdown">
          <button data-urlroot="<?= URLROOT; ?>" data-userId="<?= $_SESSION['user_id']; ?>" class="dropBtn" title='<?= $_SESSION['username']; ?>'>
            <img class="userIcon" src='<?= URLROOT . $_SESSION['profile_pic']; ?>' class='profilePicture'>
          </button>

          <div class="dropdownContent">
            <a href="<?= URLROOT; ?>/profiles/<?= $_SESSION['username']; ?>"><img src="<?= URLROOT; ?>/assets/images/icons/user-white.png" alt="user"> Profile</a>
            <a href="<?= URLROOT; ?>/dashboards/<?= $_SESSION['user_id']; ?>"><img src="<?= URLROOT; ?>/assets/images/icons/dashboard.png" alt="dashboard">Dashboard</a>
            <a href="<?= URLROOT; ?>/users/settings/<?= $_SESSION['user_id']; ?>"><img src="<?= URLROOT; ?>/assets/images/icons/settings.png" alt="settings">Settings</a>
            <a href="<?= URLROOT; ?>/users/logout"><img src="<?= URLROOT; ?>/assets/images/icons/logout.png" alt="logout">Logout</a>
          </div>
        </div>

      <?php else: ?>

        <a class="signInBtn" href="<?=URLROOT;?>/users/signin">
          <img src="<?= URLROOT; ?>/assets/images/icons/user.png">Sign In
        </a>

      <?php endif; ?>

    </div>

  </nav>

  <nav class="mobNav">
    <ul class="mobNavList">
      <li class="sidebarListItem">
        <a href="<?= URLROOT; ?>" class="sidebarLink">
          <img src="<?= URLROOT; ?>/assets/images/icons/home.png" alt="Home icon">
          <p>Home</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="<?= URLROOT; ?>/pages/trending" class="sidebarLink">
          <img src="<?= URLROOT; ?>/assets/images/icons/trending.png" alt="trending icon">
          <p>Trending</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="<?= URLROOT; ?>/pages/subscriptions" class="sidebarLink">
          <img src="<?= URLROOT; ?>/assets/images/icons/subscribe.png" alt="subscribe icon">
          <p>Subscriptions</p>
        </a>
      </li>

      <li class="sidebarListItem">
        <a href="<?= URLROOT; ?>/pages/likedVideos" class="sidebarLink">
          <img src="<?= URLROOT; ?>/assets/images/icons/like.png" alt="like video icon">
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
            <a href="<?= URLROOT; ?>" class="sidebarLink" title="Home">
              <img src="<?= URLROOT; ?>/assets/images/icons/home.png" alt="Home icon">
              <p class="hiddenSidebar">Home</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="<?= URLROOT; ?>/pages/trending" class="sidebarLink" title="Trending">
              <img src="<?= URLROOT; ?>/assets/images/icons/trending.png" alt="trending icon">
              <p class="hiddenSidebar">Trending</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="<?= URLROOT; ?>/pages/subscriptions" class="sidebarLink" title="Subscriptions">
              <img src="<?= URLROOT; ?>/assets/images/icons/subscribe.png" alt="subscribe icon">
              <p class="hiddenSidebar">Subscriptions</p>
            </a>
          </li>

          <li class="sidebarListItem">
            <a href="<?= URLROOT; ?>/pages/likedVideos" class="sidebarLink" title="Liked Videos">
              <img src="<?= URLROOT; ?>/assets/images/icons/like.png" alt="like video icon">
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

            <?php foreach ($data['subs'] as $sub) : ?>

              <li class="sidebarListItem">
                <a href="<?= URLROOT; ?>/profiles/<?= $sub->username; ?>" class="sidebarLink" title="<?= $sub->username; ?>">
                  <img class="subsIcon" src="<?= URLROOT . $sub->profilePic; ?>" alt="user icon">
                  <p class="hiddenSidebar"><?= $sub->username; ?></p>
                </a>
              </li>

            <?php endforeach; ?>

          </ul>
        </div>

        <div class="sidebar__bottom">
          <ul class="sidebarList">
            <li class="sidebarListItem">
              <a href="<?= URLROOT; ?>/users/settings/<?= $_SESSION['user_id']; ?>" class="sidebarLink" title="Settings">
                <img src="<?= URLROOT; ?>/assets/images/icons/settings.png" alt="settings icon">
                <p class="hiddenSidebar">Settings</p>
              </a>
            </li>

            <li class="sidebarListItem">
              <a href="<?= URLROOT; ?>/users/logout" class="sidebarLink" title="Logout">
                <img src="<?= URLROOT; ?>/assets/images/icons/logout.png" alt="logout icon">
                <p class="hiddenSidebar">Logout</p>
              </a>
            </li>
          </ul>
        </div>

      <?php endif; ?>

    </aside>