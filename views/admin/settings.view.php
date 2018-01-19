<div class="wrapper-post-profile">

  <?php if(isset($status)) echo $status; ?>

  <h2>Settings</h2>

  <form action="" method="post" enctype="multipart/form-data">
    <div class="box">
      <label>Logo Image:</label>
      <?php if (!empty($setting['logo'])) : ?>
        <img src="images/<?= $setting['logo']; ?>" height="100"/>
      <?php endif; ?>
      <input type="file" name="logo">
    </div>
    <div class="box">
      <label>Facebook URL:</label>
      <input type="url" name="facebook" value="<?php echo isset($setting['facebook']) ? $setting['facebook'] : ''; ?>">
    </div>
    <div class="box">
      <label>Twitter URL:</label>
      <input type="url" name="twitter" value="<?php echo isset($setting['twitter']) ? $setting['twitter'] : ''; ?>">
    </div>
    <div class="box">
      <label>Footer Copyright Info:</label>
      <textarea name="copyrightinfo" rows="4"><?php echo isset($setting['copyrightinfo']) ? $setting['copyrightinfo'] : ''; ?></textarea>
    </div>
    <div class="box-submit">
      <input type="submit" name="profile" value="Update">
    </div>
  </form>

</div>
