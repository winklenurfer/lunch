<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<?php
require ('lib/dbConnect.php');

/* Database connection */
$dbCon = new dbConnection();
$con = $dbCon->databaseConnect();
/*~~~~~~~~~~~~~~~~~~~~*/

$select = "SELECT name
		FROM restaurants
		ORDER BY RAND()
		LIMIT 3"
		or die("Error in the consult.." . mysqli_error($con));

$selectResult = $con->query($select);
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
mysqli_close($con);

?>

</body>
</html>