<? include 'header.php' ?>

<?

if (isset($_SESSION['error'])) unset($_SESSION['error']);

if (isset($_POST['login'])) {
	
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

	switch ($_POST['pass']) {
		case '':
			$_SESSION['error'] .= 'Пароль не может быть пустым<br><br>';
		break;
		case strlen($_POST['pass']) < 3:
			$_SESSION['error'] .= 'Пароль слишком короткий<br><br>';
		break;
		case !preg_match("/[А-Яа-яA-Za-z].*[0-9]|[0-9].*[А-Яа-яA-Za-z]/", $_POST['pass']):
			$_SESSION['error'] .= 'Пароль слишком простой. Он должен содержать хотя бы 1 букву и быть длиной от 6 символов<br><br>';
		break;
		default:
			unset($_SESSION['error']);
		break;
	}

	if ($_POST['repass'] == '') $_SESSION['error'] .= 'Повтор пароля не может быть пустым<br><br>';
	if ($_POST['pass'] != $_POST['repass']) $_SESSION['error'] .= 'Пароли не совпадают<br><br>';
	
	if (!isset($_SESSION['error']))
	{
		$mysqli->query("INSERT INTO users (login, email, pass, registered) VALUES ('$_POST[login]', '$_POST[email]', '" . md5($_POST[pass]) . "', '" . date("Y-m-d") . "')");

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Регистрация</h3>
	<h4>Для добавления книг Вам необходимо пройти процедуру регистрации</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<div class="success">Регистрация прошла успешно. Теперь Вы можете <a href="/login">войти на сайт</a>, пройдя авторизацию.</div>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
		<form method="POST">
			<input type="text" placeholder="Логин" name="login">
			<p>Логин должен быть уникальным, может содержать только буквы латинского алфавита и цифры. Длина от 3 до 20 символов.</p>
			<input type="text" placeholder="E-mail" name="email">
			<p>E-mail необходим для связи с Вами, а также для восстановления пароля в случае его потери.</p>
			<input type="password" placeholder="Пароль" name="pass">
			<p>Пароль должен быть сложным, содержать хотя бы 1 букву. Длина от 5 до 30 символов.</p>
			<input type="password" placeholder="Повторите пароль" name="repass">
			
			<br>

			<input type="submit" value="Зарегестрироваться">
		</form>
	<? endif ?>
</main>