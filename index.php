<?

session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dojo Pong</title>
	<script src="http://d3js.org/d3.v3.min.js"></script>
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
		<!-- <div>
			<label>Partner:(optional)</label>
			<input type="text" name="partner">
		</div> -->
		<div>
			<label>Score</label>
			<input type="number" name="score">
		</div>
		<div>
			<label>Opponent's Name</label>
			<input type="text" name="opponent_name">
		</div>
		<!-- <div>
			<label>Opponent's Partner(optional):</label>
			<input type="text" name="opponent_partner">
		</div> -->
			<label>Opponent's Score</label>
			<input type="number" name="opponent_score">
		<div>
			<input type="submit" value="Track">
		</div>
	</form>


	<script type="text/javascript">
		var diameter = 600,
		    format = d3.format(",d"),
		    color = d3.scale.category20c();

		var bubble = d3.layout.pack()
		    .sort(null)
		    .size([diameter, diameter])
		    .padding(1.5);

		var svg = d3.select("body").append("svg")
		    .attr("width", diameter)
		    .attr("height", diameter)
		    .attr("class", "bubble");

		d3.json("flare_users.json.php", function(error, root) {
		  var node = svg.selectAll(".node")
		      .data(bubble.nodes(classes(root))
		      .filter(function(d) { return !d.children; }))
		    .enter().append("g")
		      .attr("class", "node")
		      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

		  node.append("title")
		      .text(function(d) { return d.className + ": " + format(d.value); });

		  node.append("circle")
		      .attr("r", function(d) { return d.r; })
		      .style("fill", function(d) { return color(d.packageName); });

		  node.append("text")
		      .attr("dy", ".3em")
		      .style("text-anchor", "middle")
		      .text(function(d) { return d.className.substring(0, d.r / 3); });
		});

		// Returns a flattened hierarchy containing all leaf nodes under the root.
		function classes(root) {
		  var classes = [];

		  function recurse(name, node) {
		    if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
		    else classes.push({packageName: name, className: node.name, value: node.size});
		  }

		  recurse(null, root);
		  return {children: classes};
		}

		d3.select(self.frameElement).style("height", diameter + "px");

	</script>


</body>
</html>