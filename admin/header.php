<? if (session_id() == '') session_start(); ?>
<? if (!isset($_SESSION['login'])) header('Location: /login') ?>
<? if (!isset($mysqli)) $mysqli = new mysqli('localhost', 'root', '', 'roga'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"> 
	<title>Рога и Копыта - электронная библиотека</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>

<header>
	<hgroup>
		<div id="left">
			<img src="../img/photo.png">
			<p>Лучшая библиотека<br>в интернете</p>
			<p class="description">© В.В. Жириновский</p>
		</div>
		<a href="//roga.ru">
			<div id="center">
				<h1>Рога и Копыта</h1>
				<h2>Электронная библиотека</h2>
			</div>
		</a>
		<div id="right"><a href="/admin/logout">Выход</a></div>
	</hgroup>
</header>

<aside>
	<h3>Жанры книг</h3>
	<ul>
		<a href="/admin"><li>Мои книги</li></a>
		<? if ($_SESSION['type'] == 'admin'): ?><a href="/admin/users.php"><li>Пользователи</li></a><? endif ?>
		<? if ($_SESSION['type'] == 'admin'): ?><a href="/admin/genres.php"><li>Жанры</li></a><? endif ?>
		<a href="/admin/addbook.php"><li>Добавить книгу</li></a>
		<a href="/admin/addgenre.php"><li>Добавить жанр</li></a>
		<a href="/admin/logout"><li>Выход</li></a>
	</ul>
</aside>