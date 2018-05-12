<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cart</title>
	</head>
	<body>

	<?php
	$items = $_SESSION["items"];
	
	Echo "you have ";
	if(!empty($items))
	{
		foreach($items as $item) {
			echo "<p>$item</p>";
		}
		
		echo '<form action="header3.php" method="POST">
		<input type="submit" value="Check Out">
	</form>';
	}
	else
	{
		echo "nothing in your cart.";
	}
	?>
	
	<form action="browse.php" method="POST">
		<input type="submit" value="Go Back">
	</form>
	
	</body>
</html>