<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';
require '../libs/Posts.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}
if ( Session::get('userrole') == 'editor' ) {
  header('Location: index.php');
}

$user  = new User();
$posts = new Posts();
$users = $user->userRoleRelation();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $role_name    = $_POST['name'];
  $user_id      = $_POST['uid'];

  if (empty($role_name)) {
    $status = '<p class="alert-error">Please select role!</p>';

  }else{
    $userexists = $user->getUserRoleById($user_id);

    if ($userexists) {

      $update = $user->updateUserRole($role_name, $user_id);
      if ($update) {
        $status = '<p class="alert-success">Role updated successfully.</p>';

      }else{
        $status = '<p class="alert-error">Error: Problem in updating data!</p>';
      }

    }else{

      $insert = $user->insertUserRole($role_name, $user_id);
      if ($insert) {
        $status = '<p class="alert-success">Role assaign successfully.</p>';

      }else{
        $status = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }
    }

  }

}else{
  $status = '';
}



view_admin('roles', array(
  'users'   => $users,
  'status'  => $status,
  'posts'   => $posts

));
