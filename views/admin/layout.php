
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <div class="dashboard-wrapper">

      <nav>
        <ul>
          <li><a href="index.php"><strong>DEVCAN</strong></a></li>
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="../index.php" target="_blank">Site</a></li>
        </ul>
        <ul class="socials">
        <?php if(Session::check('userlogin')) : ?>
          <li><a class="usericon" href="profile.php"><?php echo Session::get('username'); ?></a></li>
          <li><a href="logout.php?action=logout">Logout</a></li>
        <?php endif; ?>
        </ul>
      </nav>
      <section class="dashboard">
        <aside class="dashboard-sidebar">
          <ul>
            <?php if( Session::get('userrole') == 'admin' ) : ?>

              <li><a href="posts.php">Posts</a></li>
              <li><a href="create.php">Create Post</a></li>
              <li><a href="category.php">Category</a></li>
              <li><a href="create-category.php">Create Category</a></li>
              <li><a href="roles.php">Roles</a></li>
              <li><a href="settings.php">Settings</a></li>

            <?php elseif( Session::get('userrole') == 'editor' ) : ?>

              <li><a href="posts.php">Posts</a></li>
              <li><a href="create.php">Create Post</a></li>
              <li><a href="category.php">Category</a></li>
              <li><a href="create-category.php">Create Category</a></li>

            <?php
              else:
                header('Location: ../index.php');
              endif;
            ?>
          </ul>
        </aside>
        <div class="dashboard-main">

          <?php include($path); ?>

        </div>
      </section>

      <footer>
        <p>&copy;2017<a href="https://developercanvas.com/"> Developer Canvas</a> - All right reserved.</p>
      </footer>

    </div>
  </body>
</html>
