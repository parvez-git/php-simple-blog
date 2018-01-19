<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';
require '../libs/Posts.php';
require '../libs/Category.php';
require '../libs/Comments.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$alluser      = new User();
$allpost      = new Posts();
$allcategory  = new Category();
$comments     = new Comments();

$users      = $alluser->getUsers();
$posts      = $allpost->getPosts();
$categories = $allcategory->getCategory();

view_admin('posts', array(
  'users'       => $users,
  'posts'       => $posts,
  'categories'  => $categories,
  'comments'    => $comments
));
