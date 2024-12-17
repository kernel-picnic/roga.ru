<?php

  session_start();
  $_SESSION = array();
  session_destroy();

  foreach ($_COOKIE as $key => $value) setcookie($key, $value, time() - 259200, '/');

  $location = $_SERVER['HTTP_REFERER'];
  header ("Location: //roga.ru");

?>