<? include 'header.php' ?>

<main>
	<h3 class="title">Жанры</h3>
	<h4>Жанры, добавленные администратором и пользователями, а также жанры, ожидающие проверку администратором.</h4>

	<hr>

	<? if ($_SESSION['type'] != 'admin'): ?>
		<div class="error">Для просмотра этой страницы Вы должны обладать правами администратора. Обратитесь к Администратору для получения дополнительной информации.</div>
	<? else: ?>
		<table>
			<tr>
				<td>№</td>
				<td>Название</td>
				<td>Адрес</td>
				<td>Редактирование</td>
			</tr>
			<? $num = 1; ?>
			<? $result = $mysqli->query("SELECT * FROM genres"); ?>
			<? while ($genre = $result->fetch_array()): ?>
				<tr>
					<td><?= $num++ ?></td>
					<td><?=$genre['title']?></td>
					<td><?=$genre['url']?></td>
					<td>
						<a href="editgenre.php?genre_id=<?=$genre['id']?>">Редактировать жанр</a><br>
						<? if ($genre['approved'] != 1): ?><a href="approve.php?genre_id=<?=$genre['id']?>">Одобрить жанр</a><br><? endif ?>
						<a href="delgenre.php?genre_id=<?=$genre['id']?>">Удалить жанр</a>
					</td>
				</tr>
			<? endwhile ?>
		</table>
	<? endif ?>
</main>