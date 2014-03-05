<?php
// DB connection
$link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link));

// Escape $_POST
if (!$_POST['name']) {
	echo "Please enter a name.";
	exit();
}

$processedPost = $link->real_escape_string($_POST['name']);

// Store all current DB entries
$num = "SELECT COUNT(*) as count FROM restaurants WHERE name = '$processedPost'";
$numResult = $link->query($num);

if ($numResult) {
	$row = $numResult->fetch_array();
	if ($row['count'] > 0) {
		echo $_POST['name'] . " already exists...";
		exit();
	}
}

// Add 
$query = "INSERT INTO restaurants (name) VALUES ('$processedPost')" or die("Error in the consult.." . mysqli_error($link));

//execute the query.

$result = $link->query($query);

if ($result) {
	echo $_POST['name'] . " entered successfully!<br>";
}

//display information:
$selectAll = "SELECT name FROM restaurants";
$selectAllResult = $link->query($selectAll);

while($row = $selectAllResult->fetch_array()) {
	echo $row["name"] . "<br>";
}

mysqli_close($link);

?>