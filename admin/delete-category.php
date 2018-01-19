<?php
require '../libs/Session.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$category = new Category();

if ( isset($_GET['id']) ) {

  $id = (int)$_GET['id'];
  $delete = $category->deleteCategory($id);

  if ($delete) {
    header('Location: category.php');
  }
}
