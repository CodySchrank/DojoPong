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
		$esc_name = escape_this_string($post['name']);
		$name = strtolower(str_replace(" ", "_", $esc_name));
	}

	// if (isset($post['partner'])) {
	// 	$partner = escape_this_string($post['partner']);
	// }

	if(empty($post['score'])) {
		$_SESSION['errors'][] = "You Must Set your score";
	} else {
		$score = escape_this_string($post['score']);
	}

	if(empty($post['opponent_name'])) {
		$_SESSION['errors'][] = "Opponents Name is not valid";
	} else {
		$esc_opponent_name = escape_this_string($post['opponent_name']);
		$opponent_name = strtolower(str_replace(" ", "_", $esc_opponent_name));
	}

	// if (isset($post['opponent_partner'])) {
	// 	$opponent_partner = escape_this_string($post['opponent_partner']);
	// }

	if(empty($post['opponent_score'])) {
		$_SESSION['errors'][] = "You Must Set your opponents score";
	} else {
		$opponent_wins = escape_this_string($post['opponent_score']);
	}

	if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {

		header('location: index.php');
		die();

	} else {
		$name1 = "SELECT * FROM players WHERE name='{$name}'";
		$name2 = "SELECT * FROM players WHERE name='{$opponent_name}'";
		$names[] = fetch_record($name1);
		$names[] = fetch_record($name2);
		// ------ CHECKS IF PLAYER 1 EXISTS THEN GRABS INFO AS NAMES[0] ------
		if(empty($names[0])){
			$insert = "INSERT INTO players (name, created_at) VALUES ('{$name}', NOW())";
			run_mysql_query($insert);
			$query = "SELECT * FROM players WHERE name='{$name}' OR name='{$opponent_name}'";
			$names = fetch_all($query);
		}

		// ------ CHECKS IF PLAYER 2 EXISTS THEN GRABS INFO AS NAMES[1] ------
		if(empty($names[1])) {
			$insert = "INSERT INTO players (name, created_at) VALUES ('{$opponent_name}', NOW())";
			run_mysql_query($insert);
			$query = "SELECT * FROM players WHERE name='{$name}' OR name='{$opponent_name}'";
			$names = fetch_all($query);
		}
		// ----- INSERTS BOTH PLAYERS INTO DB WITH SCORE, USE ALIAS TO ACCESS ------
		if($_POST['score'] > $_POST['opponent_score']) {
			$winner = $names[0]['id'];
		} else {
			$winner = $names[1]['id'];
		}

		$scores_query = "INSERT INTO games (player1_id, player2_id, player1_score, player2_score, created_at, winner) 
						 VALUES ({$names[0]['id']}, {$names[1]['id']}, {$_POST['score']}, {$_POST['opponent_score']}, NOW(), {$winner})";
		run_mysql_query($scores_query);
		header('location: index.php');
		die();
	}
}

?>