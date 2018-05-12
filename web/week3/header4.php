<?php
	session_start();
	$_SESSION["street"] = $_POST["street"];
	$_SESSION["houseNum"] = $_POST["number"];
	$_SESSION["city"] = $_POST["city"];
	$_SESSION["state"] = $_POST["state"];
	$_SESSION["zip"] = $_POST["zipCode"];
?>

<html>
	<head>
		<title>Confirmation</title>
	</head>
	<body>
		<h2>Confirmation Page</h2>
		<br>
		<?php
			echo "The following items: ";
			$items = $_SESSION["items"];
				foreach($items as $item){
					echo "<p>$item</p>";
				}
			echo "will be delivered to your place: " . $_SESSION["street"] . ", " . $_SESSION["houseNum"] . ", " . $_SESSION["city"] . " " . $_SESSION["state"] . " " . $_SESSION["zipCode"];
		?>
		<h3>Thank you.</h3>
		<?php 
			session_unset();
			session_destroy();
		?>
		<form action="browse.php" method="POST">
			<input type="submit" value="Return to Main">
		</form> 
	</body>
</html>