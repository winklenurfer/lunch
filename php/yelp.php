<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- HTML5 -->
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<div class="wrapper">

<?php
require 'lib/yelpSearch.php';

if (!$_POST['name']) {	
	echo "<h1><a class='url' href='update.php'>Please provide a valid search term.</a></h1>";
} else {
	$search = new yelpSearch();
	$result = $search->search_yelp($_POST['name'],"array");

	foreach($result->businesses as $business){
		echo "<div class='card'>";
		echo "<a class='card_content'  href='" . $business->url . "'>" . $business->name . "<br>";
		echo "<img border='0' style='padding-top:10; padding-right:10' src='" . $business->rating_img_url_large . "' width='83' height='15'>";
		echo "</a>";
		echo "<form action='update.php' method='post' style='padding-left:10'>
				<button class='button add' name='name' type='submit' value='" . $business->name . "'>Add</button>
			  </form>";
		echo "</div>";
	}
}

?>

</div>
</body>
</html>