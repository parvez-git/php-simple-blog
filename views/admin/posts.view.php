<?php if($posts) : ?>

  <table>

    <thead>
      <tr>
        <th>SL.</th>
        <th>Title</th>
        <th>Content</th>
        <th>Author</th>
        <th>Category</th>
        <th>Comment</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($posts as $key => $post) : ?>
      <tr>
        <td><strong><?php echo ++$key ?>.</strong></td>
        <td><?php echo $post['title']; ?></td>
        <td><?php echo $post['content']; ?></td>
        <td>
          <?php
            if($users) {
              foreach ($users as $user) {
                if($post['user_id'] == $user['id'] ){
                  echo $user['name'];
                }
              }
            }
          ?>
        </td>
        <td>
          <?php
            if($categories) {
              foreach ($categories as $category) {
                if($post['category_id'] == $category['id'] ){
                  echo $category['name'];
                }
              }
            }
          ?>
        </td>
        <td>
          <?php
            if($comments){
              if ( $allcomments = $comments->getCommentsByPostId($post['id']) ) {
                echo '<span class="author"><i class="fa fa-comments"></i> ' . count($allcomments) . '</span>';

              }
            }
          ?>
        </td>
        <td>
          <?php if($post['image']) : ?>
            <img src="images/<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" width="80"/>
          <?php else: ?>
            <span class="crosssign"><i class="fa fa-times"></i></span>
          <?php endif; ?>
        </td>
        <td>
          <a href="view.php?id=<?= $post['id']; ?>" class="btn btn-green">View</a>

          <?php if( ($post['user_id']) === (Session::get('userid')) ): ?>
            <a href="edit.php?id=<?= $post['id']; ?>" class="btn btn-blue">Edit</a>
            <a onclick="return confirm('Are you sure?')" href="delete.php?id=<?= $post['id']; ?>" class="btn btn-red">Delete</a>
          <?php endif; ?>

        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>

  </table>



<?php endif; ?>
