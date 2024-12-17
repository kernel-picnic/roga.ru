<?

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'roga');

if (isset($_SESSION['error'])) unset($_SESSION['error']);

if (isset($_POST['login']) && isset($_POST['pass']))
{

	if ($_POST['login'] == '') $_SESSION['error'] .= 'Логин не может быть пустым<br><br>';
	if ($_POST['pass']  == '') $_SESSION['error'] .= 'Пароль не может быть пустым<br><br>';

	if (!isset($_SESSION['error']))
	{
		$result = $mysqli->query("SELECT * FROM users WHERE login = $_POST[login]");
		if ($result->num_rows == 1)
		{
			$user = $result->fetch_array();
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['id']    = $user['id'];
			$_SESSION['type']  = $user['type'];
			header("location: /admin");

			// Обновляем дату последнего входа на сайт
			$mysqli->query("UPDATE users SET enter = '" . date("Y-m-d") . "' WHERE login = '$_POST[login]'");
		}
		else
		{
			$_SESSION['error'] = 'Неправильный логин или пароль. Проверьте правильность введённых данных и повторите попытку.<br><br>';
		}
	}
}

?>

<? include 'header.php' ?>

<main>
	<h3 class="title">Авторизация</h3>
	<h4>Войдите на сайт, чтобы использовать все его возможности</h4>

	<hr>

	<? if (isset($_SESSION['error'])): ?>
		<div class="error"><br><?=$_SESSION['error']?></div>
	<? endif ?>

	<form method="POST">
		<p>Если у Вас нет логина и пароля, <a href="/registration">пройдите регистрацию</a> на сайте.</p>

		<input type="text" placeholder="Логин" name="login">
		<input type="password" placeholder="Пароль" name="pass">

		<br>

		<input type="submit" value="Войти">
	</form>
</main>