
<section class="layout">
  <a href="" class="thumbnail"><i class="fa fa-th"></i></a>
  <a href="" class="list"><i class="fa fa-th-list"></i></a>
</section>

<section class="blocks">

  <?php foreach ($posts as $post) : ?>
    <article>
      <?php if($post['image']) : ?>
        <div class="image" style="background-image: url(admin/images/<?= $post['image']; ?>)"></div>
      <?php endif; ?>
      <div class="content">
        <h2>
          <a href="single.php?id=<?= $post['id'] ?>">
            <?php echo $post['title']; ?>
          </a>
        </h2>
        <p><?php echo $post['content']; ?></p>
        <?php
          if($users):
            foreach ($users as $user):
              if ($user['id'] == $post['user_id']) {
                echo '<span class="author"><i class="fa fa-user"></i> ' . $user['name'] . '</span>';
              }
            endforeach;
          endif;
        ?>
        <?php
          if($categories):
            foreach ($categories as $category):
              if ($category['id'] == $post['category_id']) {
                echo '<span class="category"><i class="fa fa-envira"></i> ' . $category['name'] . '</span>';
              }
            endforeach;
          endif;
        ?>
        <?php
          if($comments){
            if ( $allcomments = $comments->getCommentsByPostId($post['id']) ) {
              echo '<span class="author"><i class="fa fa-comments"></i> ' . count($allcomments) . '</span>';
            }
          }
        ?>
      </div>
    </article>
  <?php endforeach; ?>

</section>
