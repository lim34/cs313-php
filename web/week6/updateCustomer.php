<?php

	session_start();
	
	try
	{
//		$dbUrl = getenv('DATABASE_URL');

//  		$dbopts = parse_url($dbUrl);

//  		$dbHost = $dbopts["host"];
//  		$dbPort = $dbopts["port"];
//  		$dbUser = $dbopts["user"];
//  		$dbPassword = $dbopts["pass"];
//  		$dbName = ltrim($dbopts["path"],'/');

//  		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  
  		$user = 'Lim';
  		$password = 'Dlaehd123';
  		$db = new PDO('pgsql:host=localhost;dbname=photography', $user, $password);
	}
	catch (PDOException $ex)
	{
  		echo 'Error!: ' . $ex->getMessage();
  		die();
	}

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phoneNumber = $_POST['phoneNumber'];
	$email = $_POST['email'];
	
	$stmt = $db->prepare('SELECT firstname, lastname, phonenumber, emailaddress FROM customer
	where firstname = :firstname and lastname = :lastname and phonenumber = :phonenumber
	and emailaddress = :emailaddress;');
	$stmt->bindValue(':firstname', $firstName);
	$stmt->bindValue(':lastname', $lastName);
	$stmt->bindValue(':phonenumber', $phoneNumber);
	$stmt->bindValue(':emailaddress', $email);	
	$stmt->execute();
	
	$_SESSION['firstName'] = $firstName;
	$_SESSION['lastName'] = $lastName;
	$_SESSION['phoneNumber'] = $phoneNumber;
	$_SESSION['email'] = $email;
	
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if(!is_null($rows) && !empty($rows))
	{
		echo "**************************************************************** <br>";
		echo "* You must enter all input values in order to update.           * <br>";
		echo "* For info that doesn't need to be updated, type the same value.* <br>";
		echo "**************************************************************** <br>";
		foreach($rows as $row)
		{
			echo "Welcome, " . $row['firstname'] . " " . $row['lastname'] . "<br>";
		}
		echo "What information would you like to update?";
		echo '<form name="form" action="updateCustomer2.php" method="POST">';
		echo 'First Name: <input type="text"" name="firstName2" required="required"><br>';
		echo 'Last Name:  <input type="text" name="lastName2" required="required"><br>';
		echo 'Phone Number: <input type="text" name="phoneNumber2" placeholder="xxx-xxx-xxxx" required="required"><br>';
		echo 'Email Address: <input type="text" name="email2" required="required"><br>';
		echo '<input type="submit" value="Submit the form" name="submitButton"/>';
		echo '</form>';
	}
	
	else
	{
		echo "There's no customer that matches the information you provided. Please check your info again.";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
			body {background-color: beige; font-family: arial;}
		</style>
	</head>
	<body>
		
		<form name="form" action="redirectUpdateCustomer.php" method="POST">
			<input type="submit" value="Go back to update customer page"/>	
		</form>
	</body>
</html>