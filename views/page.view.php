<section class="single-block">

  <?php
    if(isset($title)) {
       echo '<h2>'.$title.'</h2>';
    }else{
       echo '<h2>Page not found!</h2>';
    }

    if(isset($content)) {
       echo $content;
    }
  ?>

</section>
