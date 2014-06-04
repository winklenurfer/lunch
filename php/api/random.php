<?php
require ('../lib/dbConnect.php');

function get_random_restaurants($num){
	/* Database connection */
	$dbCon = new dbConnection();
	$con = $dbCon->databaseConnect();
	/*~~~~~~~~~~~~~~~~~~~~*/
	
	$select = "SELECT name
			FROM restaurants
			ORDER BY RAND()
			LIMIT $num"
			or die("Error in the consult.." . mysqli_error($con));
	
	$selectResult = $con->query($select);
	
	$list = array();
	while($row = $selectResult->fetch_array()) {
		array_push($list, $row[0]);
	}

	echo json_encode($list);
}

if (isset($_GET["num"]) && (int) $_GET["num"] > 0 && (int) $_GET["num"] < 51) {
	get_random_restaurants($_GET["num"]);
} else {
	get_random_restaurants(3);
}

mysqli_close($con);

?>