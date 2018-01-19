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

$users      = $alluser->getUsers();
$posts      = $allpost->getPosts();
$categories = $allcategory->getCategory();


view('index', array(
  'users'      => $users,
  'posts'      => $posts,
  'categories' => $categories,
  'comments'   => $comments
));
