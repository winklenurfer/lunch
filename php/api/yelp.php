<?php

// Enter the path that the oauth library is in relation to the php file
require_once ('../lib/yelpSearch.php');

if (isset($_GET["term"])) {
	$term = $_GET["term"];
} else {
	echo "Error: Please enter a valid search term.";
	exit();
}

$yelpSearch = new yelpSearch();

echo $yelpSearch->search_yelp($term,"json");

/*if (isset($_GET["location"])) {
	$location = $_GET["location"];
} else {
	$location = 'Financial%20District';
}*/

?>