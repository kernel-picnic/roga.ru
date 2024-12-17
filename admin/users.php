<? include 'header.php' ?>

<main>
	<h3 class="title">Пользователи</h3>
	<h4>Все пользователи, зарегестрировавшиеся на сайте</h4>

	<hr>

	<? if ($_SESSION['type'] != 'admin'): ?>
		<div class="error">Для просмотра этой страницы Вы должны обладать правами администратора. Обратитесь к Администратору для получения дополнительной информации.</div>
	<? else: ?>
		<table>
			<tr>
				<td>№</td>
				<td>Логин</td>
				<td>Тип</td>
				<td>Добавил книг</td>
				<td>Последний вход</td>
				<td>Дата регистрации</td>
				<td>Редактирование</td>
			</tr>
			<? $num = 1; ?>
			<? $result = $mysqli->query("SELECT * FROM users"); ?>
			<? while ($user = $result->fetch_array()): ?>
				<tr>
					<td><?= $num++ ?></td>
					<td><?=$user['login']?></td>
					<td><?=$user['type']?></td>
					<td><?=$user['books']?></td>
					<td><?=$user['enter']?></td>
					<td><?=$user['registered']?></td>
					<td>
						<? if ($user['type'] != 'admin'): ?>
							<a href="edituser.php?user_id=<?=$user['id']?>">Редактировать</a><br>
							<a href="deluser.php?user_id=<?=$user['id']?>">Удалить</a>
						<? endif ?>
					</td>
				</tr>
			<? endwhile ?>
		</table>
	<? endif ?>
</main>