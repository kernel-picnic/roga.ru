<? include 'header.php' ?>

<?

if (isset($_SESSION['error'])) unset($_SESSION['error']);

if (isset($_POST['title']))
{

	switch ($_POST['title'])
	{
		case '':
			$_SESSION['error'] .= 'Название книги не может быть пустым<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}



	switch ($_POST['author'])
	{
		case '':
			$_SESSION['error'] .= 'Автор книги должен быть заполнен<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}

	switch ($_POST['year'])
	{
		case '':
			$_SESSION['error'] .= 'Год написания книги должен быть заполнен<br><br>';
		break;
		case !preg_match("/[0-9]/", $_POST['year']):
			$_SESSION['error'] .= 'Некорректный года написания книги<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}

	switch ($_POST['price'])
	{
		case '':
			$_SESSION['error'] .= 'Цена не может быть пустая. Мы не распространяем книги бесплатно.<br><br>';
		break;	
		default:
			unset($_SESSION['error']);
		break;
	}

	if (!isset($_SESSION['error']))
	{
		$mysqli->query("UPDATE books SET title = '$_POST[title]', author = '$_POST[author]', year = '$_POST[year]', genre = '$_POST[genre]', price = '$_POST[price]' WHERE id = '$_POST[book_id]'");

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Редактирование книги</h3>
	<h4>Ниже Вы можете отредактировать книгу, которую Вы добавили.</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<div class="success">Книга успешно отредактирована. Теперь Вы можете просмотреть её <a href="/admin">здесь</a>.</div>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
	<? endif ?>

	<? $result = $mysqli->query("SELECT * FROM books WHERE id = '$_GET[book_id]'"); ?>
	<? $book   = $result->fetch_array(); ?>
	<form method="POST">
		<input type="text" value="<?=$book['title']?>" name="title">
		<input type="text" value="<?=$book['author']?>" name="author">
		<input type="text" value="<?=$book['year']?>" name="year">
		<select name="genre">
			<? $result = $mysqli->query("SELECT title FROM genres"); ?>
			<? while ($genre = $result->fetch_array()): ?>
				<option><?=$genre['title']?></option>
			<? endwhile ?>
		</select>
		<input type="text" value="<?=$book['price']?>" name="price">
		<input type="hidden" value="<?=$book['id']?>" name="book_id">
		<br>
		<input type="submit" value="Сохранить">
	</form>
</main>