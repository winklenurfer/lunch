<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- HTML5 -->
<meta charset="utf-8">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,900' rel='stylesheet' type='text/css'>
<link href='css/gh-buttons.css' rel='stylesheet' type='text/css' media='screen'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='screen'>
<body>

<div class='wrapper'>
	<div>What about one of these places?</div>
	
	<div class='card'>
		<?php
		require ('lib/dbRestaurants.php');
		$dbRestaurants = new dbRestaurants();
		$restaurants = $dbRestaurants->get_random_restaurants(3);
		
		// Loop through 3 random restaurants and display
		$i = 1;
		foreach ($restaurants as $restaurant) {
			echo "<div class='random_item_" . $i . "'>" . $restaurant . "</div>";
			$i++;
		}
		?>
	</div>
	
	<a href='update.php' class='button big'>Add/Remove</a>
	<a href='index.php' class='button big'>Refresh</a>
</div>
</body>
</html>