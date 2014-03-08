<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<form action="update.php" method="post">
	Name: <input type="text" name="name">
	<input type="submit">
</form>

<?php
// DB connection
$link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link));

// Display all restaurants
function showAll(){
	$link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link));
	
	$selectAll = "SELECT name FROM restaurants";
	$selectAllResult = $link->query($selectAll);
	
	echo "<h3>Current restaurants:</h3>";
	echo "<div class='list_all'>";
	echo "<form action='update.php' method='post'>";
	while($row = $selectAllResult->fetch_array()) {
		echo "<div>" . $row["name"] . " " . '<button class="right" name="delete" type="submit" value="' . $row['name'] . '">Delete</button></div>';
	}
	echo "</form></div>";
}

// Check for name
if (!$_POST['delete'] && !$_POST['name']){
	echo "<p>Enter restaurant name to add.</p>";
	showAll();
}

// Delete entry
if ($_POST['delete']) {
	$delete = $link->real_escape_string($_POST['delete']);

	$query = "DELETE FROM restaurants WHERE name = '$delete'" or die("Error in the consult.." . mysqli_error($link));
	$result = $link->query($query);

	if ($result) {
		echo "<p class='action'>[ " . $_POST['delete'] . " deleted! ]</p>";
	}
	showAll();
}

if ($_POST['name']) {
	// Escape $_POST
	$processedPost = $link->real_escape_string($_POST['name']);

	$num = "SELECT COUNT(*) as count FROM restaurants WHERE name = '$processedPost'";
	$numResult = $link->query($num);
	
	// Check for pre-existing entry
	if ($numResult) {
		$row = $numResult->fetch_array();
		if ($row['count'] > 0) {
			echo "<p class='action'>[ " . $_POST['name'] . " already exists... ]<p>";
			showAll();
		} else {
			// Add new entry 
			$query = "INSERT INTO restaurants (name) VALUES ('$processedPost')" or die("Error in the consult.." . mysqli_error($link));
			
			$result = $link->query($query);
			
			if ($result) {
				echo "<p class='action'>[ " . $_POST['name'] . " entered successfully! ]</p>";
			}
			showAll();
		}
	}
}


mysqli_close($link);

?>

</body>
</html>