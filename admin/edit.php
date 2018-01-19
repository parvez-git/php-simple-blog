<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Posts.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$post       = new Posts();
$category   = new Category();
$categories = $category->getCategory();

$data = array();
$data['categories'] = $categories;

if ( isset($_GET['id']) ) {
  $postid = (int)$_GET['id'];
  $postedit = $post->getPostById( $postid );
  if ($postedit['user_id'] == Session::get('userid')) {
    $data['post'] = $postedit;
  }else{
    header('Location: posts.php');
  }

}else{
  header('Location: posts.php');
}

if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_GET['id']) ) {
  $title        = $_POST['title'];
  $content      = $_POST['content'];
  $category_id  = $_POST['category_id'];
  $id           = (int)$_GET['id'];
  $image        = $_FILES['image']['name'];

  if (empty($title) || empty($content) || empty($category_id)) {
    $data['status'] = '<p class="alert-error">Please Fill all fields!</p>';

  }else{

    if ( empty($image) == false ) {

      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp  = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext  = strtolower( pathinfo($file_name, PATHINFO_EXTENSION) );

      $err = array();

      $expensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$expensions)=== false){
        $err['status1'] = 'Extension not allowed, please choose a JPEG or PNG file! ';
      }

      if($file_size > 2097152) {
        $err['status2'] = ' File size must be smaller than 2 MB!';
      }

      if( empty($err) ) {
        $image = 'post-'.rand(100,10000000).'-'.strtotime("now").'.'.$file_ext;

        move_uploaded_file($file_tmp,"images/".$image);

        $update = $post->updatePost($title, $content, $category_id, $image, $id);

        if ($update) {
          unlink('images/'.$postedit['image']);
          header("Location: edit.php?id=$postid");
          Session::set('postupdatemsg','<p class="alert-success">Post updated successfully.</p>');

        }else{
          $data['status'] = '<p class="alert-error">Error: Problem in updating data!</p>';
        }

      }else{
        $s1 = isset($err['status1']) ? $err['status1'] : ' ';
        $s2 = isset($err['status2']) ? $err['status2'] : ' ';
        $data['status'] = '<p class="alert-error">'.$s1.$s2.'</p>';
      }

    }else{
      $image = $postedit['image'];

      $update = $post->updatePost($title, $content, $category_id, $image, $id);
      if ($update) {
        $data['status'] = '<p class="alert-success">Post updated successfully.</p>';

      }else{
        $data['status'] = '<p class="alert-error">Error: Problem in updating data!</p>';
      }
    }


  }

}


view_admin('edit', $data);
