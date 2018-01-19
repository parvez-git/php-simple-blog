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

if (isset($_GET['id'])) {
  $data['category'] = $category->getCategoryById( (int)$_GET['id'] );
}else{
  header('Location: category.php');
}

if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_GET['id']) ) {
  $cat_name = $_POST['name'];
  $id       = (int)$_GET['id'];

  if (empty($cat_name)) {
    $data['status'] = '<p class="alert-error">Please Fill both field!</p>';

  }else{
    $update = $category->updateCategory($cat_name, $id);
    if ($update) {
      $data['status'] = '<p class="alert-success">Category updated successfully.</p>';

    }else{
      $data['status'] = '<p class="alert-error">Error: Problem in updating data!</p>';
    }

  }

}

view_admin('edit-category', $data);
