<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- HTML5 -->
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<div class="wrapper">

<?php
require 'lib/yelp.php';

if (!$_POST['name']) {	
	echo "<h1><a href='update.php'>Please provide a valid search term.</a></h1>";
} else {
	$search = new yelpSearch();
	$result = $search->search_yelp($_POST['name']);

	foreach($result->businesses as $business){
		echo "<div>";
		echo "<a href='" . $business->url . "'>" . $business->name . "<br>";
		echo "<img border='0' src='" . $business->rating_img_url_large . "' width='83' height='15'>";
		echo "</a>";
		echo "</div>";
	}
}

?>

</div>
</body>
</html>