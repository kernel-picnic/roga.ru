<? if (session_id() == '') session_start(); ?>
<? if (!isset($mysqli)) $mysqli = new mysqli('localhost', 'root', '', 'roga'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"> 
	<title>Рога и Копыта - электронная библиотека</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<header>
	<hgroup>
		<div id="left">
			<img src="img/photo.png">
			<p>Лучшая библиотека<br>в интернете</p>
			<p class="description">© В.В. Жириновский</p>
		</div>
		<a href="//roga.ru">
			<div id="center">
				<h1>Рога и Копыта</h1>
				<h2>Электронная библиотека</h2>
			</div>
		</a>
		<div id="right">
			<? if (isset($_SESSION['login'])): ?>
				<a href="/admin">Админ-панель</a>
			<? else: ?>
				<a href="/login">Вход</a> / <a href="/registration">Регистрация</a>
			<? endif ?>
		</div>
	</hgroup>
</header>

<aside>
	<h3>Жанры книг</h3>
	<ul>
		<? $result = $mysqli->query("SELECT * FROM genres WHERE approved = 1"); ?>
		<? while ($genre = $result->fetch_array()): ?>
			<a href="genre?genre=<?=$genre['url']?>"><li><?=$genre['title']?></li></a>
		<? endwhile ?>
	</ul>
</aside>