<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name     = $_POST['name'];
  $email    = $_POST['email'];
  $message  = $_POST['message'];

  if (empty($name) || empty($email) || empty($message)) {
    $status = '<p class="alert alert-error">Please fill all fields properly!</p>';
  }else{

    $to      = "p4alam@gmail.com";
    $subject = "My subject";
    $message = $message;
    $headers = "From: $email" . "\r\n";

    mail($to,$subject,$message,$headers);

    $name     = '';
    $email    = '';
    $message  = '';
    $status   = '<p class="alert alert-success">Mail send successfully.</p>';

  }
}else{
  $status = '';
}

view('contact', array(
  'status' => $status
));
