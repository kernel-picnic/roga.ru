<? include 'header.php' ?>

<? $result = $mysqli->query("SELECT * FROM genres WHERE url = '$_GET[genre]'"); ?>
<? $genre  = $result->fetch_array(); ?>

<main>
	<h3 class="title">Самые популярные книги в жанре "<?=$genre['title']?>"</h3>
	<h4>По версии наших читателей</h4>

	<hr>

	<? $result = $mysqli->query("SELECT * FROM books WHERE genre = '$genre[title]'"); ?>
	<? if ($result->num_rows == 0): ?>
		<p>В этом жанре пока не добавлено ни одной книги. А жаль.</p>
	<? else: ?>
		<? while ($book = $result->fetch_array()): ?>
			<section class="book">
				<img src="img/books/<?=$book['id']?>.jpg" alt="<?=$book['title']?>" width="140" height="200" style="border-radius:15px;">
				<div class="description">
					<div class="title"><?=$book['title']?></div>
					<div class="information"><?=$book['author']?> (<?=$book['year']?>)<br>Раздел: <?=$book['genre']?></div>
				</div>
				<div class="buy">Купить за <?=$book['price']?> руб.</div>
			</section>
		<? endwhile ?>
	<? endif ?>
</main>