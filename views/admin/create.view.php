
<div class="wrapper-post wrapper-post-create">

  <?php if(isset($status)) echo $status;?>

  <h2>Create a new post.</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <div class="box">
      <label>Title</label>
      <input type="text" name="title">
    </div>
    <div class="box">
      <label>Content</label>
      <textarea name="content" rows="8" cols="40"></textarea>
    </div>
    <div class="box">
      <label>Category</label>
      <select class="" name="category_id">
        <?php
          if($categories) :
            foreach ($categories as $category):
        ?>
            <option value = "<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
        <?php
            endforeach;
        else:
        ?>
        <option value='0'>No Category</option>
        <?php endif; ?>
      </select>
    </div>
    <div class="box">
      <label>Image</label>
      <input type="file" name="image">
    </div>
    <div class="box-submit">
      <input type="submit" name="create" value="Create Post">
    </div>
  </form>

</div>
