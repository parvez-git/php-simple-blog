<section class="single-block">

  <article>
    <?php if(!empty($post['image'])): ?>
      <img src="admin/images/<?= $post['image']; ?>" alt="<?= $post['title']; ?>" />
    <?php endif; ?>
    <div class="content">
      <h1><?php echo $post['title']; ?></h1>
      <p><?php echo $post['content']; ?></p>
      <?php
        if($users):
          foreach ($users as $user):
            if ($user['id'] == $post['user_id']) {
              echo '<span class="author"><i class="fa fa-user"></i> ' . $user['name'] . '</span> ';
            }
          endforeach;
        endif;

        if($categories):
          foreach ($categories as $category):
            if ($category['id'] == $post['category_id']) {
              echo '<span class="category"><i class="fa fa-envira"></i> ' . $category['name'] . '</span> ';
            }
          endforeach;
        endif;

        if($comments){
          if ( $allcomments = $comments->getCommentsByPostId($post['id']) ) {
            echo '<span class="author"><i class="fa fa-comments"></i> ' . count($allcomments) . '</span>';

          }
        }
      ?>
    </div>

    <?php
    if($comments) :
      if( $allcomments = $comments->getCommentsByPostId($post['id']) ) :
    ?>
    <div class="comments comment-box">
      <h2>All Comments</h2>
      <ul>
        <?php

          foreach ($allcomments as $comment) :
        ?>
        <li>
        <?php
          if($users):
            foreach ($users as $user):
              if ($user['id'] == $comment['user_id']) {
                echo '<h3>'.$user['name'].'</h3>';
              }
            endforeach;
          endif;
          ?>
          <p><?php echo $comment['comment']; ?></p>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
    <?php endif; endif; ?>

    <?php if( Session::check('userlogin') ) : ?>
    <div class="comment-box">
      <?php if(isset($data['status'])) echo $data['status']['status']; ?>
      <form action="" method="post">
        <div class="box">
          <label><h2>Leave a comment</h2></label>
          <textarea name="comment" rows="8" cols="40"></textarea>
        </div>
        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo Session::get('userid'); ?>">
        <div class="box">
          <input type="submit" name="commentbtn" value="Leave a comment">
        </div>
      </form>
    </div>
    <?php endif; ?>

  </article>

</section>
