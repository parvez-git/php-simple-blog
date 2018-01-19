<?php

class Session{

  public static function init()
  {
    session_start();
  }

  public static function check($key)
  {
     return isset($_SESSION[$key]);
  }

  public static function set($key, $val)
  {
    $_SESSION[$key] = $val;
  }

  public static function get($key)
  {
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }

    return false;

  }

  public static function destroy(){
    session_destroy();
    session_unset();
  }

}
