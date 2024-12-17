<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'roga');

if (isset($_GET['genre_id']) && $_SESSION['type'] == 'admin') $mysqli->query("DELETE FROM genres WHERE id = '$_GET[genre_id]'");

header("Location: $_SERVER[HTTP_REFERER]");