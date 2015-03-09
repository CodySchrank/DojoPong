<?

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dojo Pong</title>
</head>
<body>
	<h1>Welcome To Dojo Pong</h1>
	<h3>Track your stats</h3>
	<?

	if(isset($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $error) {
			echo "<p class='error'>".$error."</p><br>";
		}
		unset($_SESSION['errors']);
	}

	?>
	<form action="process.php" method="post">
		<div>
			<label>Your Name:</label>
			<input type="text" name="name">
		</div>
		<div>
			<label>Partner:(optional)</label>
			<input type="text" name="partner">
		</div>
		<div>
			<label>Wins</label>
			<input type="number" name="wins">
		</div>
		<div>
			<label>Opponent's Name</label>
			<input type="text" name="opponent_name">
		</div>
		<div>
			<label>Opponent's Partner(optional):</label>
			<input type="text" name="opponent_partner">
		</div>
			<label>Opponent's Wins</label>
			<input type="number" name="opponent_wins">
		<div>
			<input type="submit" value="Track">
		</div>
	</form>


</body>
</html>