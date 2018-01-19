
<div class="wrapper-post wrapper-post-category">

  <?php if(isset($status)) echo $status; ?>

  <h2>Create a new Category</h2>

  <form action="" method="post">
    <div class="box">
      <label>Category</label>
      <input type="text" name="name">
    </div>
    <div class="box-submit">
      <input type="submit" name="category" value="Create Category">
    </div>
  </form>

</div>
