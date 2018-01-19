<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Posts.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}
Session::set('postupdatemsg', '');

$user_id    = Session::get('userid');
$post       = new Posts();
$category   = new Category();
$categories = $category->getCategory();

$data = array();
$data['categories'] = $categories;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title       = $_POST['title'];
  $content     = $_POST['content'];
  $category_id = $_POST['category_id'];

  if (empty($title) || empty($content) || empty($category_id)) {
    $data['status'] = '<p class="alert-error">Please fill all fields properly!</p>';

  }else{

    if ( empty($_FILES['image']['name']) == false ) {

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
        $insert = $post->insertPost($title, $content, $user_id, $category_id, $image);
        if ($insert) {
          $data['status'] = '<p class="alert-success">Post created successfully.</p>';

        }else{
          $data['status'] = '<p class="alert-error">Error: Problem in inserting data!</p>';
        }

      }else{
        $s1 = isset($err['status1']) ? $err['status1'] : ' ';
        $s2 = isset($err['status2']) ? $err['status2'] : ' ';
        $data['status'] = '<p class="alert-error">'.$s1.$s2.'</p>';
      }

    }else{
      $image = '';

      $insert = $post->insertPost($title, $content, $user_id, $category_id, $image);
      if ($insert) {
        $data['status'] = '<p class="alert-success">Post created successfully.</p>';

      }else{
        $data['status'] = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }
    }


  }

}

view_admin('create', $data);
