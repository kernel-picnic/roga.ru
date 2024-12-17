<?php

$mysqli = new mysqli('localhost', 'root', '', 'roga');

if (isset($_GET['book_id'])) $mysqli->query("DELETE FROM books WHERE id = '$_GET[book_id]'");

header("Location: $_SERVER[HTTP_REFERER]");