<?php
	try
	{
		$dbUrl = getenv('DATABASE_URL');

  		$dbopts = parse_url($dbUrl);

  		$dbHost = $dbopts["host"];
  		$dbPort = $dbopts["port"];
  		$dbUser = $dbopts["user"];
  		$dbPassword = $dbopts["pass"];
  		$dbName = ltrim($dbopts["path"],'/');

  		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	
//  		$user = 'Lim';
//  		$password = 'Dlaehd123';
//  		$db = new PDO('pgsql:host=localhost;dbname=photography', $user, $password);
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
	
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	if(is_null($rows) || empty($rows))
	{
	
		$stmt = $db->prepare('INSERT INTO customer (firstname, lastname, phonenumber, emailaddress, contactdate) 
		VALUES (:firstname, :lastname, :phonenumber, :emailaddress, now());');
		$stmt->bindValue(':firstname', $firstName);
		$stmt->bindValue(':lastname', $lastName);
		$stmt->bindValue(':phonenumber', $phoneNumber);
		$stmt->bindValue(':emailaddress', $email);
		$stmt->execute();
	
	
		echo "your customer information has been saved successfully. <br>";
 
		$stmt = $db->prepare('SELECT firstname, lastname, phonenumber, emailaddress FROM customer
		where firstname = :firstname and lastname = :lastname and phonenumber = :phonenumber
		and emailaddress = :emailaddress;');
		$stmt->bindValue(':firstname', $firstName);
		$stmt->bindValue(':lastname', $lastName);
		$stmt->bindValue(':phonenumber', $phoneNumber);
		$stmt->bindValue(':emailaddress', $email);	
	
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach($rows as $row)
		{
			echo 'First Name: ' . $row['firstname'] . '<br/>';
			echo 'Last Name: ' . $row['lastname'] . '<br/>';
			echo 'Phone Number: ' . $row['phonenumber'] . '<br/>';
			echo 'Email Address: ' . $row['emailaddress'] . '<br/>';
		}
	}
	
	else
	{
		echo "This customer already exists. Please check your info again.";
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
		<form name="form" action="redirectCreateCustomer.php" method="POST">
			<input type="submit" value="Go back to create customer page"/>	
		</form>
	</body>
</html>
