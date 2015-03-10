<?

require('new-connection.php');
session_start();

if(isset($_POST)) {
	insertData($_POST);
}

function insertData($post) {

	if(empty($post['name'])) {
		$_SESSION['errors'][] = "Your Name is not valid";
	} else {
		$name = escape_this_string($post['name']);
	}

	if (isset($post['partner'])) {
		$partner = escape_this_string($post['partner']);
	}

	if(empty($post['wins'])) {
		$_SESSION['errors'][] = "You Must Set your wins";
	} else {
		$wins = escape_this_string($post['wins']);
	}

	if(empty($post['opponent_name'])) {
		$_SESSION['errors'][] = "Opponents Name is not valid";
	} else {
		$opponent_name = escape_this_string($post['opponent_name']);
	}

	if (isset($post['opponent_partner'])) {
		$opponent_partner = escape_this_string($post['opponent_partner']);
	}

	if(empty($post['opponent_wins'])) {
		$_SESSION['errors'][] = "You Must Set your opponents wins";
	} else {
		$opponent_wins = escape_this_string($post['opponent_wins']);
	}

	if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {

		header('location: index.php');
		die();

	} else {
		$query = "INSERT INTO games (name, partner, wins, opponent_name, opponent_partner, opponent_wins, created_at)
				  VALUES ('{$name}','{$partner}',{$wins},'{$opponent_name}','{$opponent_partner}',{$opponent_wins}, NOW())";
		run_mysql_query($query);
		header('location: index.php');
		die();
	}
	
}

?>