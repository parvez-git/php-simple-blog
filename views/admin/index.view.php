
<div class="items">

  <div class="item one">
    <h3 class="btn btn-green">Users</h3>
    <h1><?php echo $usernum ? count($usernum) : '0'; ?></h1>
    <p>Total <strong><?php echo $usernum ? count($usernum) : '0'; ?></strong> registered user.</p>
  </div>

  <div class="item two">
    <h3 class="btn btn-red">Posts</h3>
    <h1><?php echo $postnum ? count($postnum) : '0'; ?></h1>
    <p>Total <strong><?php echo $postnum ? count($postnum) : '0'; ?></strong> post published.</p>
  </div>

  <div class="item three">
    <h3 class="btn btn-blue">Categories</h3>
    <h1><?php echo $category ? count($category) : '0'; ?></h1>
    <p>Total <strong><?php echo $category ? count($category) : '0'; ?></strong> category published.</p>
  </div>

<?php if($allusers) : foreach($allusers as $users) : ?>
  <div class="item four">
    <h3 class="btn"><?php echo $users['name']; ?></h3>
    <h1>
      <?php
      foreach($posts->countPostByUserId($users['id']) as $userpost){
        echo $userpost['useridcount'];
      }
      ?>
    </h1>
    <p><?php echo $users['name']; ?> published <strong>
      <?php
      foreach($posts->countPostByUserId($users['id']) as $userpost){
        echo $userpost['useridcount'];
      }
      ?>
    </strong> post.</p>
  </div>
<?php endforeach; endif; ?>

</div>
