<?

header('Content-Type: application/json');

require('new-connection.php');

function json_win_rate() {
	$names_query = "SELECT players.name, players.id FROM players";
	$total_query = "SELECT * FROM games";
	$names = fetch_all($names_query);
	$total = count(fetch_all($total_query));
	// var_dump($names);
	// var_dump($total);
	echo '{';
	echo '"name": "flare",';
	echo '"children": [ ';
	foreach ($names as $key => $name) {
		if($key == 0) {
			$count_query = "SELECT count(*) FROM players LEFT JOIN games ON players.id = games.player1_id
			LEFT JOIN players as player2 ON player2.id = games.player2_id
			WHERE winner = {$name['id']}";
			$player_query =  "SELECT count(*) FROM players LEFT JOIN games ON players.id = games.player1_id
			LEFT JOIN players as player2 ON player2.id = games.player2_id
			WHERE player1_id = {$name['id']} OR player2_id = {$name['id']}";
			$player = fetch_all($player_query);
			$count = fetch_all($count_query);
			$total = count(fetch_all($total_query));
			$normal = floor((($count[0]["count(*)"]/$player[0]["count(*)"]) * 100)/$total);
			echo '{';
			echo '"name": "'.$key.'",';
			echo '"children": [{"name": "'.ucwords(str_replace("_"," ",$name['name'])).'", "size":'.$normal.'}]';
			echo "}";
		} else {
			$count_query = "SELECT count(*) FROM players LEFT JOIN games ON players.id = games.player1_id
			LEFT JOIN players as player2 ON player2.id = games.player2_id
			WHERE winner = {$name['id']}";
			$player_query =  "SELECT count(*) FROM players LEFT JOIN games ON players.id = games.player1_id
			LEFT JOIN players as player2 ON player2.id = games.player2_id
			WHERE player1_id = {$name['id']} OR player2_id = {$name['id']}";
			$player = fetch_all($player_query);
			$count = fetch_all($count_query);
			$total = count(fetch_all($total_query));
			$normal = floor((($count[0]["count(*)"]/$player[0]["count(*)"]) * 100)/$total);
			echo ',{';
			echo '"name": "'.$key.'",';
			echo '"children": [{"name": "'.ucwords(str_replace("_"," ",$name['name'])).'", "size":'.$normal.'}]';
			echo "}";
		}
	}
	echo "]";
	echo "}";
}

json_win_rate();

// $count = 'SELECT count(*) FROM players LEFT JOIN games ON players.id = games.player1_id
// LEFT JOIN players as player2 ON player2.id = games.player2_id
// WHERE winner = {NAME}';


// {
// 	"name": "flare",
// 	"children": [ 
// 		{
// 			"name": "1",
// 			"children": [{"name": "Cody","size": 50}]
// 		},
// 		{
// 			"name": "2",
// 			"children": [{"name": "Antony", "size": 10}]
// 		},
// 		{
// 			"name": "3",
// 			"children": [{"name": "Josh", "size": 10}]
// 		},
// 		{
// 			"name": "4",
// 			"children": [{"name": "Arash", "size": 5}]
// 		},
// 		{
// 			"name": "5",
// 			"children": [{"name": "Courtney", "size": 10}]
// 		},
// 		{
// 			"name": "6",
// 			"children": [{"name": "Brian", "size": 15}]
// 		}
// 	]
// }


?>