<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/Settings.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}
if ( Session::get('userrole') == 'editor' ) {
  header('Location: index.php');
}

$settings = new Settings();
$setting  = $settings->getSettings();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $logo     = $_FILES['logo']['name'];
  $facebook = $_POST['facebook'];
  $twitter  = $_POST['twitter'];
  $copyinfo = $_POST['copyrightinfo'];


  if (empty($facebook) || empty($copyinfo)) {
    $status = '<p class="alert-error">Please fill facebook and copyrightinfo fields!</p>';

  }else{

    if ($setting) {

      if ( !empty($logo) == true ) {

        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp  = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $file_expl = explode( '.', $file_name );
        $file_ext  = strtolower( end($file_expl) );

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
          $status = '<p class="alert-error">extension not allowed, please choose a JPEG or PNG file!</p>';
        }

        if($file_size > 2097152) {
          $status = '<p class="alert-error">File size must be excately 2 MB!</p>';
        }

        if( empty($status) == true ) {
          move_uploaded_file($file_tmp,"images/".$file_name);
          $logo = $file_name;
        }else{
          $status = '<p class="alert-error">Problem in uploading logo!</p>';
        }

      }else{
        $setting = $setting['logo'];
      }

      $update = $settings->updateSettings($logo, $facebook, $twitter, $copyinfo);
      if ($update) {
        $status = '<p class="alert-success">Settings updated successfully.</p>';

      }else{
        $status = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }

    } else {

      if ( !empty($logo) == true ) {

        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_tmp  = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $file_expl = explode( '.', $file_name );
        $file_ext  = strtolower( end($file_expl) );

        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
          $status = '<p class="alert-error">extension not allowed, please choose a JPEG or PNG file!</p>';
        }

        if($file_size > 2097152) {
          $status = '<p class="alert-error">File size must be excately 2 MB!</p>';
        }

        if( empty($status) == true ) {
          move_uploaded_file($file_tmp,"images/".$file_name);
          $logo = $file_name;
        }else{
          $status = '<p class="alert-error">Problem in uploading logo!</p>';
        }

      }else{
        $logo = '';
      }

      $insert = $settings->insertSettings($logo, $facebook, $twitter, $copyinfo);
      if ($insert) {
        $status = '<p class="alert-success">Settings created successfully.</p>';

      }else{
        $status = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }

    }

  }

}else{
  $status = '';
}

view_admin('settings', array(
  'setting' => $setting,
  'status'  => $status
));
