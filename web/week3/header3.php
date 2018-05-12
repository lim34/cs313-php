<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Check Out</title>
	</head>
	<body>
		<form action="header4.php" method="POST">
			Street Name:<br>
			<input type="text" name="street" placeholder="525 S. Center St."><br>
			Apt Number:<br>
			<input type="text" name="number" placeholder="#200"><br>
			City:<br>
			<input type="text" name="city" placeholder="Rexburg"><br>
			State:<br>
			<input type="text" name="state" placeholder="ID"><br>
			Zip Code:<br>
			<input type="text" name="zipCode" placeholder="83460"><br>
			
			<input type="submit" value="Confirm">
		</form>
		<form action="browse.php" method="POST">
			<input type="submit" value="Return">
		</form>
	</body>
</html>