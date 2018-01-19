<?php
  require_once 'libs/Session.php';
  require_once 'libs/Settings.php';
  Session::init();
  $settings = new Settings();
  $setting  = $settings->getSettings();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <nav>
      <ul>
        <li>
          <?php if($setting['logo']) : ?>
          <a href="index.php" class="logoimage">
            <img src="admin/images/<?php echo $setting['logo']; ?>" alt="DEVCAN"/>
          </a>
          <?php else: ?>
            <a href="index.php"><strong>DEVCAN</strong></a>
          <?php endif; ?>
        </li>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <ul class="socials">
        <?php if(Session::check('userlogin')) : ?>
          <li><a class="usericon" href="admin/profile.php"><?php echo Session::get('username'); ?></a></li>
          <li><a href="admin/logout.php?action=logout">Logout</a></li>
        <?php else: ?>
          <li><a href="admin/login.php">Login</a></li>
          <li><a href="admin/registration.php">Registration</a></li>
        <?php endif; ?>

        <li><a href="<?php echo ($setting['facebook']) ? $setting['facebook'] : '#'; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="<?php echo ($setting['twitter']) ? $setting['twitter'] : '#'; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
      </ul>
    </nav>

    <div class="wrapper">

      <?php include($path); ?>

    </div>

    <footer class="footer">
      <?php if($setting['copyrightinfo']) : ?>
        <p><?php echo $setting['copyrightinfo']; ?></p>
      <?php else: ?>
        <p>&copy;2017<a href="https://developercanvas.com/"> Developer Canvas</a> - All right reserved.</p>
      <?php endif; ?>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
