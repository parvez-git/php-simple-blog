<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';
require '../libs/Profile.php';

Session::init();
if (Session::check('userlogin')) {
  header('Location: index.php');
}

$user     = new User();
$profile  = new Profile();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email    = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $status = '<p class="alert-error">Fields must not be empty!</p>';

  }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $status = '<p class="alert-error">Invalid email address!</p>';

  }else{
    $login = $user->loginUser($email, $password);
    if($login){

      Session::set('userlogin', true);
      Session::set('userid', $login['id']);
      Session::set('name', $login['name']);
      Session::set('username', $login['username']);

      $userrole = $user->getUserRoleById($login['id']);
      if ($userrole) {
        Session::set('userrole', $userrole['name']);
      }else{
        Session::set('userrole', 'subscriber');
      }
      Session::set('loginmsg', '<p class="alert-success">You have login successfully.</p>');
      $status = '';

      header('Location: index.php');
      exit();

    }
    $status = '<p class="alert-error">Error: Problem in login!</p>';
  }


}else{
  $status = '';
}

view_login('admin/login', array(
  'title' => 'Login',
  'status' => $status
));
