<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Posts.php';
require '../libs/User.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$user       = new User();
$post       = new Posts();
$category   = new Category();
$users      = $user->getUsers();
$categories = $category->getCategory();

$data = array();
$data['users'] = $users;
$data['categories'] = $categories;

if (isset($_GET['id'])) {
  $data['post'] = $post->getPostById( (int)$_GET['id'] );
}else{
  header('Location: posts.php');
}


view_admin('postview', $data);
