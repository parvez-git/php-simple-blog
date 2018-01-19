<?php
require '../functions.php';
require '../libs/Session.php';

if ( isset($_GET['action']) && ($_GET['action'] == 'logout') ) {

  Session::init();
  Session::destroy();
  header('Location: login.php');

}
