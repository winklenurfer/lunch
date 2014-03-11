<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<?php
// $link = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($link)); // Local DB
$link = mysqli_connect('127.10.207.2:3306', 'adminyMddRhL', 'M6iuBUi6WG_A', 'lunch') or die("Error " . mysqli_error($link)); // Prod DB

$select = "SELECT name
		FROM restaurants
		ORDER BY RAND()
		LIMIT 3"
		or die("Error in the consult.." . mysqli_error($link));

$selectResult = $link->query($select);
echo "<div class='wrapper'>";
echo "<div>What about one of these places?</div>";
echo "<div class='random'>";
$i = 1;
while($row = $selectResult->fetch_array()) {
	echo "<div class='random_item_" . $i . "'>" . $row["name"] . "</div>";
	$i++;
}
echo "</div>";

echo "<a href='update.php' class='button big'>Add/Remove</a>";
echo "<a href='index.php' class='button big'>Refresh</a>";
echo "</div>";
mysqli_close($link);

?>

</body>
</html>