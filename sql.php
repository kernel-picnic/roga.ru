<?

$mysql = mysql_connect('localhost', 'root', '');
mysql_select_db('mk');

echo $id = $_POST['id'];

$query  = "SELECT * FROM users WHERE id = $id";
$result = mysql_query($query);

while ($user = mysql_fetch_array($result))
	echo $user;

?>

<br><br>

<form method="POST">
	<input type="text" value="2'" name="id"></input>
	<input type="submit"></input>
</form>