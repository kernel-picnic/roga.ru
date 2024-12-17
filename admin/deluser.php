<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'roga');

if (isset($_GET['user_id']) && $_SESSION['type'] == 'admin') $mysqli->query("DELETE FROM users WHERE id = '$_GET[user_id]'");

header("Location: $_SERVER[HTTP_REFERER]");