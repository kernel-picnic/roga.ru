<? include 'header.php' ?>

<?

if (isset($_SESSION['error'])) unset($_SESSION['error']);

if (isset($_POST['login']))
{

	switch ($_POST['login']) {
		case '':
			$_SESSION['error'] .= 'Логин не может быть пустым<br><br>';
		break;
		case strlen($_POST['login']) < 3:
			$_SESSION['error'] .= 'Логин слишком короткий<br><br>';
		break;
		case strlen($_POST['login']) > 20:
			$_SESSION['error'] .= 'Логин слишком длинный<br><br>';
		break;
		case !preg_match("/[A-Za-z0-9]+/", $_POST['login']):
			$_SESSION['error'] .= 'Логин может содержать только буквы латинского алфавита и цифры<br><br>';
		break;
		default:
			unset($_SESSION['error']);
		break;
	}

	$result = $mysqli->query("SELECT id FROM users WHERE login = '$_POST[login]'");
	if ($result->num_rows != 0) $_SESSION['error'] = 'Пользователь с таким логином уже зарегестрирован<br><br>';

	switch ($_POST['email']) {
		case '':
			$_SESSION['error'] .= 'E-mail не может быть пустым<br><br>';
		break;
		case !preg_match("/[a-z\d._%+-]+@[a-z\d.-]+\.[a-z]{2,4}\b/i", $_POST['email']):
			$_SESSION['error'] .= 'Некорректно введён e-mail. Пример: "ivanov@email.com"<br><br>';
		break;
		default:
			unset($_SESSION['error']);
		break;
	}

	if (!isset($_SESSION['error']))
	{
		if ($_POST['pass'] != '')
		{
			$mysqli->query("UPDATE users SET login = '$_POST[login]', type = '$_POST[type]', pass = '" . md5($_POST['pass']) . "', email = '$_POST[email]' WHERE id = '$_POST[user_id]'");
		}
		else
		{
			$mysqli->query("UPDATE users SET login = '$_POST[login]', type = '$_POST[type]', email = '$_POST[email]' WHERE id = '$_POST[user_id]'");
		}

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Редактирование пользователя</h3>
	<h4>Ниже Вы можете отредактировать выбранного пользователя</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<div class="success">Информация о пользователе успешно отредактирована</div>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
	<? endif ?>

	<? $result = $mysqli->query("SELECT * FROM users WHERE id = '$_GET[user_id]'"); ?>
	<? $user   = $result->fetch_array(); ?>
	<form method="POST">
		<input type="text" value="<?=$user['login']?>" name="login">
		<input type="text" placeholder="Пароль" name="pass">
		<input type="text" value="<?=$user['email']?>" name="email">
		<select name="type">
			<option value="user">Пользователь</option>
			<option value="admin" <? if ($user['type'] == 'admin'): ?>selected<? endif ?>>Администратор</option>
		</select>
		<input type="hidden" value="<?=$user['id']?>" name="user_id">
		<br>
		<input type="submit" value="Сохранить">
	</form>
</main>