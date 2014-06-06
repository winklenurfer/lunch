<?php
require_once ('../lib/dbRestaurants.php');

$dbRestaurants = new dbRestaurants();

if (isset($_GET["num"]) && (int) $_GET["num"] > 0 && (int) $_GET["num"] < 51) {
	echo json_encode($dbRestaurants->get_random_restaurants($_GET["num"]));
} else {
	echo json_encode($dbRestaurants->get_random_restaurants(3));
}

?>