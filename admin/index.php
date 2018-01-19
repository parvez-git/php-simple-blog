<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';
require '../libs/Posts.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$users    = new User();
$posts    = new Posts();
$category = new Category();

$usersnum = $users->getUsers();
$postnum  = $posts->getPosts();
$categnum = $category->getCategory();

view_admin('index', array(
  'allusers' => $usersnum,
  'posts'    => $posts,
  'usernum'  => $usersnum,
  'postnum'  => $postnum,
  'category' => $categnum
));
