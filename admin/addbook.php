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
		$mysqli->query("INSERT INTO books (title, author, year, genre, price, user) VALUES ('$_POST[title]', '$_POST[author]', '$_POST[year]', '$_POST[genre]', '$_POST[price]', '$_SESSION[id]')");

		if (isset($_FILES))	move_uploaded_file($_FILES["photo"]["tmp_name"], "../img/books/" . $mysqli->insert_id . ".jpg");
		$mysqli->query("UPDATE users SET book = book + 1 WHERE login = '$_SESSION[login]'");

		$_SESSION['error'] = 'no';
	}
}

?>

<main>
	<h3 class="title">Добавить новую книгу</h3>
	<h4>Для добавления новой книги заполните все поля, приведённые ниже</h4>

	<hr>

	<? if ($_SESSION['error'] == 'no'): ?>
		<div class="success">Книга успешно добавлена. Теперь Вы можете просмотреть её <a href="/admin">здесь</a>.</div>
	<? else: ?>
		<? if (isset($_SESSION['error'])): ?>
			<div class="error"><br><?=$_SESSION['error']?></div>
		<? endif ?>
	<? endif ?>
	<form method="POST" enctype="multipart/form-data">
		<input type="text" placeholder="Название книги" name="title">
		<p>Название книги может содержать как буквы латинского алфавита, так и кириллицу. Также в названии разрешены знаки пунктуации.</p>
		<input type="text" placeholder="Автор" name="author">
		<input type="text" placeholder="Год написания" name="year" maxlength="4">
		<p>Указывайте только год написания книги, без обозначения года её публикации.</p>
		<select name="genre">
			<? $result = $mysqli->query("SELECT title FROM genres"); ?>
			<? while ($genre = $result->fetch_array()): ?>
				<option><?=$genre['title']?></option>
			<? endwhile ?>
		</select>
		<p>Выберете нужный Вам жанр, либо добавьте свой жанр <a href="/admin/addgenre">здесь</a>.</p>
		<input type="text" placeholder="Цена (в рублях)" name="price">
		<p>Цена, по которой пользователи смогут покупать Вашу книгу. Не стоит указывать слишком низкую или слишком высокую цену.</p>
		<br>
		<input type="file" name="photo">
		<p>Выберете обложку книги. Она автоматически изменит свой размер.</p>
		<br><br>
		<input type="submit" value="Добавить книгу">
	</form>
</main>