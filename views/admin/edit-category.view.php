
<div class="wrapper-post wrapper-post-category">

  <?php if(isset($status)) echo $status; ?>

  <h2>Create a new Category</h2>

  <form action="" method="post">
    <div class="box">
      <label>Category</label>
      <input type="text" name="name" value="<?php echo $category['name']; ?>">
    </div>
    <div class="box-submit">
      <input type="submit" name="category-update" value="Updare Category">
    </div>
  </form>

</div>
