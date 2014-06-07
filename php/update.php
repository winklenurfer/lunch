<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- HTML5 -->
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<div class="wrapper">
<form action="update.php" method="post">
	<input type="text" name="name">
	<input type="submit" class="button icon add" value="Add">
</form>
<br><br>
<form action="yelp.php" method="post">
	<input type="text" name="name">
	<input type="submit" class="button icon add" value="Yelp Search">
</form>

<?php
require ('lib/dbRestaurants.php');

// Display all restaurants
function showAll(){
	$dbRestaurants = new dbRestaurants();
	$allRestaurants = $dbRestaurants->get_all_restaurants();
	
	echo "<h3>Current restaurants:</h3>";
	echo "<div class='list_all'>";
	echo "<form action='update.php' method='post'>";
	foreach ($allRestaurants as $restaurant) {
		echo '<div><button class="button danger icon trash" name="delete" type="submit" value="' . $restaurant . '">' . $restaurant . '</button></div>';
	}
	echo "</form></div>";
	echo "<a href='index.php' class='button big'>Random</a>";
}

function removeWhitespace($str){
	$new_str=preg_replace('/\s+/', '', $str);
	return $new_str;
}

// Check for name
if (!$_POST['delete'] && !$_POST['name']){
	echo "<p>Enter restaurant name to add.</p>";
	showAll();
} else {
	$dbRestaurant = new dbRestaurants();

	if ($_POST['delete']) {
		// Delete restaurant
		if ($dbRestaurant->delete_restaurant_by_name($_POST['delete'])) {
			echo "<p class='action'>[ " . $_POST['delete'] . " deleted! ]</p>";
		} else {
			echo "<p class='action'>[ Error occured. Delete unsuccessful. ]</p>";
		}
		showAll();
	} else {
		// Check that length meets requirement
		if ($_POST['name'] && strlen($_POST['name']) > 0 && strlen($_POST['name']) < 31 && strlen(removeWhitespace($_POST['name'])) > 0) {
			
			// Add restaurant
			if ($dbRestaurant->add_restaurant_by_name($_POST['name'])) {
				echo "<p class='action'>[ " . $_POST['name'] . " entered successfully! ]</p>";
			} else {
				echo "<p class='action'>[ An error has occured. Check if " . $_POST['name'] . " already exists... ]<p>";
			}
			showAll();
			
		} elseif (strlen($_POST['name']) > 30) {
			echo "<p class='action'>" . $_POST['name'] . " is too long. Please use 30 characters or less.</p>";
			showAll();
		} elseif (strlen(removeWhitespace($_POST['name'])) < 1) {
			echo "<p>Enter restaurant name to add.</p>";
			showAll();
		}
	}
}

?>

</div>
</body>
</html>