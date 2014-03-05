<?php
$link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link));

$select = "SELECT name
		FROM restaurants
		ORDER BY RAND()
		LIMIT 3"
		or die("Error in the consult.." . mysqli_error($link));

$selectResult = $link->query($select);

while($row = $selectResult->fetch_array()) {
	echo $row["name"] . "<br>";
}

mysqli_close($link);

?>