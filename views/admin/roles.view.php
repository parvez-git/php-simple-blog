<?php if($users) : ?>

  <?php if(isset($status)) echo $status; ?>

  <div class="grid-table-title">
    <div class="box">SL.</div>
    <div class="box">Name & Details</div>
    <div class="box">Action</div>
  </div>

  <div class="grid-table">

    <?php foreach ($users as $key => $user) : ?>

      <div class="box one"><?php echo ++$key ?>.</div>
      <div class="box two">
        <?php echo $user['name']; ?>
        <?php
        if ($user['rolename']) {
          echo '<span class="btn-green btn-round">'.$user['rolename'].'</span>';
        }
        echo '<span class="btn-blue btn-round">'.$user['id'].'</span>';
        if($posts){
          echo '<span class="btn-red btn-round">';
          foreach($posts->countPostByUserId($user['id']) as $userpost){
              echo $userpost['useridcount'];
          }
          echo '</span>';
        }
        ?>
      </div>

      <form class="box three" action="" method="post">
      <?php
        foreach ($users as $roles) :
          if( ($roles['id'] == Session::get('userid')) && ($roles['rolename'] == 'admin') ) :
      ?>
        <select class="btn" name="name">
          <option value="subscriber" <?php echo ($user['rolename'] == 'subscriber') ? 'selected' : ''; ?>>Subscriber</option>
          <option value="editor" <?php echo ($user['rolename'] == 'editor') ? 'selected' : ''; ?>>Editor</option>
          <option value="admin" <?php echo ($user['rolename'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
        <input type="hidden" name="uid" value="<?php echo $user['id']; ?>">
        <input type="submit" class="btn btn-red" name="role" value="Assign Role">
      <?php
          endif;
        endforeach;
      ?>
      </form>

    <?php endforeach; ?>

  </div>

<?php endif; ?>
