<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<?php
$link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link));

$select = "SELECT name
		FROM restaurants
		ORDER BY RAND()
		LIMIT 3"
		or die("Error in the consult.." . mysqli_error($link));

$selectResult = $link->query($select);

echo "<div class=random>";
while($row = $selectResult->fetch_array()) {
	echo "<div>" . $row["name"] . "</div>";
}
echo "</div>";

mysqli_close($link);

?>

</body>
</html>