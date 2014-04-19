<?php
// $link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link)); // Local DB
$link = mysqli_connect('127.10.207.2:3306', 'adminyMddRhL', 'M6iuBUi6WG_A', 'lunch') or die("Error " . mysqli_error($link)); // Prod DB

$select = "SELECT name
		FROM restaurants
		ORDER BY RAND()
		LIMIT 3"
		or die("Error in the consult.." . mysqli_error($link));

$selectResult = $link->query($select);

echo json_encode($selectResult->fetch_array());

mysqli_close($link);

?>