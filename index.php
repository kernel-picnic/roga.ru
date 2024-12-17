<? include 'header.php' ?>

<main>
	<h3 class="title">Самые популярные книги</h3>
	<h4>По версии наших читателей</h4>

	<hr>

	<? $result = $mysqli->query("SELECT * FROM books"); ?>
	<? while ($book = $result->fetch_array()): ?>
		<section class="book">
			<img src="img/books/<?=$book['id']?>.jpg" alt="<?=$book['title']?>" width="140" height="200" style="border-radius:15px;">
			<div class="description">
				<div class="title"><?=$book['title']?></div>
				<div class="information"><?=$book['author']?> (<?=$book['year']?>)<br>Раздел: <?=$book['genre']?></div>
			</div>
			<div class="buy">Купить за <?=$book['price']?> руб.</div>
		</section>
	<? endwhile; ?>
</main>