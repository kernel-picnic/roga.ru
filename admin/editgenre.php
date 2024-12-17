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
		$mysqli->query("UPDATE genres SET title = '$_POST[title]', url = '$_POST[url]' WHERE id = '$_POST[genre_id]'");

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Редактирование жанра</h3>
	<h4>Ниже Вы можете отредактировать жанр</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<div class="success">Жанр успешно отредактирован.</div>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
	<? endif ?>

	<? $result = $mysqli->query("SELECT * FROM genres WHERE id = '$_GET[genre_id]'"); ?>
	<? $genre  = $result->fetch_array(); ?>
	<form method="POST">
		<input type="text" value="<?=$genre['title']?>" name="title">
		<input type="text" value="<?=$genre['url']?>" name="url">
		<input type="hidden" value="<?=$genre['id']?>" name="genre_id">
		<br>
		<input type="submit" value="Сохранить">
	</form>
</main>