<?php
require '../functions.php';
require '../libs/Session.php';
require '../libs/User.php';
require '../libs/Posts.php';
require '../libs/Category.php';
require '../libs/Profile.php';
require '../libs/Comments.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}
Session::set('postupdatemsg', '');

$users    = new User();
$post     = new Posts();
$category = new Category();
$profile  = new Profile();
$comments = new Comments();

$user_id    = Session::get('userid');

$user       = $users->getUserById($user_id);
$posts      = $post->getPostByUserId($user_id);
$profiles   = $profile->getProfileByUserId($user_id);
$categories = $category->getCategory();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $image      = $_FILES['image']['name'];
  $dob        = $_POST['dob'];
  $gender     = $_POST['gender'];
  $profession = $_POST['profession'];
  $city       = $_POST['city'];
  $address    = $_POST['address'];
  $phone      = $_POST['phone'];


  if (empty($dob) || empty($gender) || empty($profession) || empty($city) || empty($address) || empty($phone)) {
    $status = '<p class="alert-error">Please Fill all fields!</p>';

  }else{

    $profilesxists  = $profile->getProfileByUserId($user_id);

    if ($profilesxists) {

      if ( !empty($image) == true ) {

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
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
          $image = $file_name;
        }else{
          $status = '<p class="alert-error">Problem in uploading image!</p>';
        }

      }else{
        $image = $profilesxists['image'];
      }

      $update = $profile->updateProfile($image, $dob, $gender, $profession, $city, $address, $phone, $user_id);
      if ($update) {
        $status = '<p class="alert-success">Profile updated successfully.</p>';
        header("Location: profile.php");
      }else{
        $status = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }

    } else {

      if ( !empty($image) == true ) {

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
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
          $image = $file_name;
        }else{
          $status = '<p class="alert-error">Problem in uploading image!</p>';
        }

      }else{
        $image = '';
      }

      $insert = $profile->insertProfile($image, $dob, $gender, $profession, $city, $address, $phone, $user_id);
      if ($insert) {
        $status = '<p class="alert-success">Profile created successfully.</p>';

      }else{
        $status = '<p class="alert-error">Error: Problem in inserting data!</p>';
      }

    }

  }

}else{
  $status = '';
}

view_admin('profile', array(
  'user'        => $user,
  'posts'       => $posts,
  'profiles'    => $profiles,
  'categories'  => $categories,
  'comments'    => $comments,
  'status'      => $status
));
