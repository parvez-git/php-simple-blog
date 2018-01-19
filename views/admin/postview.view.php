<?php if($post): ?>
  <section class="single-post-view">

    <article>

      <?php if(!empty($post['image'])): ?>
        <img src="images/<?= $post['image']; ?>" alt="<?= $post['title']; ?>" />
      <?php endif; ?>

      <div class="content">
        <h1><?php echo $post['title']; ?></h1>
        <p><?php echo $post['content']; ?></p>
        <?php
          if($categories) :
            echo '<strong>Category: </strong><span class="category">';
            foreach ($categories as $category):
              if ($category['id'] == $post['category_id']) {
                echo $category['name'];
              }
            endforeach;
            echo '</span>';
          endif;
        ?>
        <p>
        <?php
          if($users) :
            echo '<strong>Author: </strong><span class="author">';
            foreach ($users as $user):
              if ($user['id'] == $post['user_id']) {
                echo $user['name'];
              }
            endforeach;
            echo '</span>';
          endif;
        ?>
        </p>
      </div>
    </article>

  </section>
<?php endif; ?>
