<?php
require '../libs/Session.php';
require '../libs/Posts.php';

Session::init();
if (!Session::check('userlogin')) {
  header('Location: login.php');
}

$post = new Posts();

if ( isset($_GET['id']) ) {

  $id = (int)$_GET['id'];

  $postdelete = $post->getPostById($id);

  if ($postdelete['user_id'] == Session::get('userid')) {

    $delete = $post->deletePost($id);

    if ($delete) {
      unlink('images/'.$postdelete['image']);
      header('Location: posts.php');
    }

  }else{
    header('Location: posts.php');
  }

}else{
  header('Location: posts.php');
}
