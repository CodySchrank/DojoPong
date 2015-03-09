<?

require()
session_start();

if($_POST) {
	function insertData($_POST);
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
		$name = escape_this_string($post['name']);
	}

}

?>