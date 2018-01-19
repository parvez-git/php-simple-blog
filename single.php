<?php
require 'functions.php';
require 'libs/User.php';
require 'libs/Posts.php';
require 'libs/Category.php';
require 'libs/Comments.php';

$alluser      = new User();
$allpost      = new Posts();
$allcategory  = new Category();
$comments     = new Comments();

$post       = $allpost->getPostById( (int)$_GET['id'] );
$users      = $alluser->getUsers();
$categories = $allcategory->getCategory();

$data = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $post_id = $_POST['post_id'];
  $user_id = $_POST['user_id'];
  $comment = $_POST['comment'];

  if (empty($comment) || empty($post_id) || empty($user_id)) {
    $data['status'] = '<p class="alert-error">Please fill comment field!</p>';

  }else{
    $insert = $comments->insertComments($user_id, $post_id, $comment);
    if ($insert) {
      $data['status'] = '<p class="alert-success">Comment created successfully.</p>';

    }else{
      $data['status'] = '<p class="alert-error">Error: Problem in inserting data!</p>';
    }
  }

}else{
  $data['status'] = '';
}

if ($post) {

  view('single', array(
    'post'       => $post,
    'users'      => $users,
    'categories' => $categories,
    'comments'   => $comments,
    'status'     => $data
  ));

}else{
  header('Location: index.php');
}
