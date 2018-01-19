
<div class="wrapper-post wrapper-post-edit">

  <?php if(Session::check('postupdatemsg')) echo Session::get('postupdatemsg'); ?>
  <?php if(isset($status)) echo $status; ?>

  <h2>Update Post.</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <div class="box">
      <label>Title</label>
      <input type="text" name="title" value="<?php echo $post['title']; ?>">
    </div>
    <div class="box">
      <label>Content</label>
      <textarea name="content" rows="8" cols="40"><?php echo $post['content']; ?></textarea>
    </div>
    <div class="box">
      <label>Category</label>
      <select class="" name="category_id">
        <?php
          if($categories) :
            foreach ($categories as $category):
              if ($category['id'] == $post['category_id']) {
                $selected = 'selected';
              }else{
                $selected = '';
              }
        ?>
            <option value ="<?php echo $category['id']; ?>" <?php echo $selected; ?>><?php echo $category['name']; ?></option>
        <?php
            endforeach;
        else:
        ?>
        <option value='0'>Uncategory</option>
        <?php endif; ?>
      </select>
    </div>
    <div class="box">
      <label>Image</label>
      <?php if (!empty($post['image'])) : ?>
        <img src="images/<?= $post['image']; ?>" width="100%"/>
      <?php endif; ?>
      <input type="file" name="image">
    </div>
    <div class="box-submit">
      <input type="submit" name="update" value="Update Post">
    </div>
  </form>

</div>
