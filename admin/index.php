<? include 'header.php' ?>

<main>
	<h3 class="title">Мои книги</h3>
	<h4>Здесь Вы можете просмотреть список книг, которые вы добавили за всё время.</h4>

	<hr>

	<? $result = $mysqli->query("SELECT * FROM books WHERE user = '$_SESSION[id]'"); ?>
	<? if ($result->num_rows == 0): ?>
		<p>Пока не не добавили ни одной книги. Самое время всё исправить! <a href="addbook">Добавить первую книгу</a>.</p>
	<? else: ?>
		<? while ($book = $result->fetch_array()): ?>
			<section class="book">
				<img src="../img/books/<?=$book['id']?>.jpg" alt="<?=$book['title']?>" width="140" height="200" style="border-radius:15px;">
				<div class="description">
					<div class="title"><?=$book['title']?></div>
					<div class="information">
						<?=$book['author']?> (<?=$book['year']?>)<br><?=$book['genre']?> (<?=$book['price']?> руб.)
					</div>
				</div>
				<div class="buy">
					<a href="/admin/editbook.php?book_id=<?=$book['id']?>">Редактировать</a> | <a href="/admin/delbook.php?book_id=<?=$book['id']?>">Удалить</a>
				</div>
			</section>
		<? endwhile; ?>
	<? endif ?>
</main>