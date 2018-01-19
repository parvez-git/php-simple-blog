<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';

Session::init();
if (Session::check('userlogin')) {
  header('Location: index.php');
}

$user = new User();
$data = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name     = $_POST['name'];
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = $_POST['password'];


  if (empty($name) || empty($username) || empty($email) || empty($password)) {
    $data['status'] = '<p class="alert-error">Fields must not be empty!</p>';

  }elseif (strlen($username) < 5) {
    $data['status'] = '<p class="alert-error">Username is too short!</p>';

  }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $data['status'] = '<p class="alert-error">Invalid email address!</p>';

  }elseif (strlen($password) < 5) {
    $data['status'] = '<p class="alert-error">Password is too short!</p>';

  }else{
    $emailexists = $user->checkEmail($email);
    if ($emailexists) {
      $data['status'] = '<p class="alert-error">Email already exists!</p>';

    }else{
      $insert = $user->insertUser($name, $username, $email, $password);
      if ($insert) {
        $data['status'] = '<p class="alert-success">You have registered successfully.</p>';
        header('Location: login.php');

      }else{
        $data['status'] = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }

    }
  }

}
$data['title'] = 'Registration';
view_login('admin/registration', $data);
