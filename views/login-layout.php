<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

    <nav>
      <ul>
        <li><a href="../index.php"><strong>DEVCAN</strong></a></li>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../about.php">About</a></li>
        <li><a href="../contact.php">Contact</a></li>
      </ul>
      <ul class="socials">
        <li><a href="login.php">Login</a></li>
        <li><a href="registration.php">Registration</a></li>

        <li><a href="https://www.facebook.com/parvez246" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/parvez8a8u" target="_blank"><i class="fa fa-twitter"></i></a></li>
      </ul>
    </nav>

    <div class="wrapper">

      <?php include($path); ?>

    </div>

    <footer class="footer">
      <p>&copy;2017<a href="https://developercanvas.com/"> Developer Canvas</a> - All right reserved.</p>
    </footer>

  </body>
</html>
