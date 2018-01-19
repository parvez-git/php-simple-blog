<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Category.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$category = new Category();
$data = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $category_name    = $_POST['name'];

  if (empty($category_name)) {
    $data['status'] = '<p class="alert-error">Please Fill all fields!</p>';

  }else{
    $insert = $category->insertCategory($category_name);
    if ($insert) {
      $data['status'] = '<p class="alert-success">Category created successfully.</p>';

    }else{
      $data['status'] = '<p class="alert-error">Error: Problem in inserting data!</p>';
    }

  }

}

view_admin('create-category', $data);
