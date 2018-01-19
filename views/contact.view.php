
<section>
  <div class="wrapper-contact">
    <?php if(isset($status)) echo $status; ?>
    <h1>Leave A Message</h1>
    <form class="" action="" method="post">
      <div class="box">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter Your Name" id="name">
      </div>
      <div class="box">
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Enter Your Email" id="email">
      </div>
      <div class="box">
        <label for="message">Message:</label>
        <textarea name="message" rows="8" cols="40" placeholder="Enter Your Message" id="message"></textarea>
      </div>
      <div class="box">
        <input type="submit" name="sendmessage" value="SEND">
      </div>
    </form>

  </div>

</section>
