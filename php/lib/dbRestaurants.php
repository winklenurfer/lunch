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
	
	function get_all_restaurants(){
		/* Database connection */
		$dbCon = new dbConnection();
		$con = $dbCon->databaseConnect();
		/*~~~~~~~~~~~~~~~~~~~~*/
	
		$selectAll = "SELECT name FROM restaurants" or die("Error in the consult.." . mysqli_error($con));
		$selectAllResult = $con->query($selectAll);
		
		$list = array();
		while($row = $selectAllResult->fetch_array()) {
			array_push($list, $row[0]);
		}
		
		mysqli_close($con);
	
		return $list;
	}
	
	function delete_restaurant_by_name($name){
		/* Database connection */
		$dbCon = new dbConnection();
		$con = $dbCon->databaseConnect();
		/*~~~~~~~~~~~~~~~~~~~~*/
		
		$delete = $con->real_escape_string($name);
		
		$query = "DELETE FROM restaurants WHERE name = '$delete'" or die("Error in the consult.." . mysqli_error($con));
		$result = $con->query($query);
		
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function add_restaurant_by_name($name){
		/* Database connection */
		$dbCon = new dbConnection();
		$con = $dbCon->databaseConnect();
		/*~~~~~~~~~~~~~~~~~~~~*/
		
		$add = $con->real_escape_string($name);
		
		$num = "SELECT COUNT(*) as count FROM restaurants WHERE name = '$add'";
		$numResult = $con->query($num);
		
		// Check for existing entry
		if ($numResult) {
			$row = $numResult->fetch_array();
			if ($row['count'] > 0) {
				return FALSE;
			} else {
				// Add new entry
				$query = "INSERT INTO restaurants (name) VALUES ('$add')" or die("Error in the consult.." . mysqli_error($con));
					
				$result = $con->query($query);
					
				if  ($result) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}
	
}

?>