<?php if($categories) : ?>

  <div class="grid-table-title">
    <div class="box">SL.</div>
    <div class="box">Category Name</div>
    <div class="box">Action</div>
  </div>

  <div class="grid-table">

    <?php foreach ($categories as $key => $category) : ?>

      <div class="box one"><?php echo ++$key ?>.</div>
      <div class="box two"><?php echo $category['name']; ?></div>
      <div class="box three">
        <a href="edit-category.php?id=<?= $category['id']; ?>" class="btn btn-blue">Edit</a>
        <a onclick="return confirm('Are you sure?')" href="delete-category.php?id=<?= $category['id']; ?>" class="btn btn-red">Delete</a>
      </div>

    <?php endforeach; ?>

  </div>

<?php endif; ?>
