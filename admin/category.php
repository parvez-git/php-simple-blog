<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$category = new Category();
$categories = $category->getCategory();


view_admin('category', array(
  'categories' => $categories
));
