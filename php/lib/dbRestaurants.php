<?php
require_once ('dbConnect.php');

class dbRestaurants {
	
	// Return random $num of restaurants
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
		
		mysqli_close($con);
		
		return $list;
	}
	
}

?>