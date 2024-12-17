<? include 'header.php' ?>

<?

if (isset($_SESSION['error'])) unset($_SESSION['error']);

if (isset($_POST['title']))
{

	switch ($_POST['title'])
	{
		case '':
			$_SESSION['error'] .= 'Название жанра не может быть пустым<br><br>';
		break;
		case !preg_match("/[А-я]/", $_POST['title']):
			$_SESSION['error'] .= 'Жанр может содержать только кириллицу<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}

	switch ($_POST['url'])
	{
		case '':
			$_SESSION['error'] .= 'Адрес не может быть пустым<br><br>';
		break;
		case !preg_match("/[A-z]/", $_POST['url']):
			$_SESSION['error'] .= 'Адрес может содержать только буквы латинского алфавита<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}

	if (!isset($_SESSION['error']))
	{
		if ($_SESSION['type'] == 'admin') $approved = 1;
		else $approved = 0;

		$mysqli->query("INSERT INTO genres (title, url, approved) VALUES ('$_POST[title]', '$_POST[url]', $approved)");

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Добавить новый жанр</h3>
	<h4>Для добавления нового жанра заполните все поля, приведённые ниже</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<? if ($_SESSION['type'] == 'admin'): ?>
			<div class="success">Новый жанр успешно добавлен.</div>
		<? else: ?>
			<div class="success">Новый жанр успешно отправлен на модерацию. После проверки администратором он будет добавлен (или нет).</div>
		<? endif ?>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
	<? endif ?>
	<form method="POST">
		<input type="text" placeholder="Название жанра" name="title">
		<p>Название жанра может содержать только кириллицу.</p>
		<input type="text" placeholder="Адрес" name="url">
		<p>Адрес - это текст, который будет отображаться в адресной строке.</p>
		<br><br>
		<input type="submit" value="Добавить жанр">
	</form>
</main>