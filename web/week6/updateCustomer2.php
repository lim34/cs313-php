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
	
	$firstName2 = $_POST['firstName2'];
	$lastName2 = $_POST['lastName2'];
	$phoneNumber2 = $_POST['phoneNumber2'];
	$email2 = $_POST['email2'];
	
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
	$phoneNumber = $_SESSION['phoneNumber'];
	$email = $_SESSION['email'];
			
	$stmt = $db->prepare('UPDATE customer 
	SET firstname = :firstname2, lastname = :lastname2, phonenumber = :phonenumber2, emailaddress = :emailaddress2
	WHERE firstname = :firstname and lastname = :lastname and phonenumber = :phonenumber and emailaddress = :emailaddress');
	$stmt->bindValue(':firstname', $firstName);
	$stmt->bindValue(':lastname', $lastName);
	$stmt->bindValue(':phonenumber', $phoneNumber);
	$stmt->bindValue(':emailaddress', $email);	
	$stmt->bindValue(':firstname2', $firstName2);
	$stmt->bindValue(':lastname2', $lastName2);
	$stmt->bindValue(':phonenumber2', $phoneNumber2);
	$stmt->bindValue(':emailaddress2', $email2);
	$stmt->execute();
	$message = "Your information has been successfully updated. <br>
	First Name: " . $firstName2 . "<br>" .
	"Last Name: " . $lastName2 . "<br>" .
	"Phone Number: " . $phoneNumber2 . "<br>" .
	"Email Address: " . $email2 . "<br>"; 
	
	echo $message;
	
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