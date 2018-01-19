<?php

function view( $path, $data )
{
  if ($data) {
    extract($data);
  }
  $path = $path . '.view.php';
  include 'views/layout.php';
}

function view_login( $path, $data )
{
  if ($data) {
    extract($data);
  }
  $path = $path . '.view.php';
  include 'views/login-layout.php';
}

function view_admin( $path, $data )
{
  if ($data) {
    extract($data);
  }
  $path = $path . '.view.php';
  include 'views/admin/layout.php';
}
