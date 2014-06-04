<?php

class dbConnection {
	
	function databaseConnect()
	{
		//$con = mysqli_connect('localhost', 'root', 'root', 'lunch') or die("Error " . mysqli_error($con)); // Local DB
		$con = mysqli_connect('127.10.207.2:3306', 'adminyMddRhL', 'M6iuBUi6WG_A', 'lunch') or die("Error " . mysqli_error($con)); // Prod DB
	
	
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySql: " . mysqli_connect_error();
		}
	
		return $con;
	}
	
}

?>