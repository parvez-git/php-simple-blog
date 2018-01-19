
<div class="wrapper-login">
  <h2><?php echo $title; ?></h2>

  <?php if(isset($status)) echo $status; ?>

  <form action="" method="post">
    <div class="box">
      <label>Email</label>
      <input type="email" name="email">
    </div>
    <div class="box">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="box-submit login">
      <input type="reset" name="reset" value="Reset">
      <input type="submit" name="login" value="Login">
    </div>
  </form>
</div>
