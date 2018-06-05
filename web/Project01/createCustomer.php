<?php
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
	
	
		$message = "your customer information has been saved successfully. <br><br>";
 
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
			$message .= 'First Name: ' . $row['firstname'] . '<br><br>';
			$message .= 'Last Name: ' . $row['lastname'] . '<br><br>';
			$message .= 'Phone Number: ' . $row['phonenumber'] . '<br><br>';
			$message .= 'Email Address: ' . $row['emailaddress'] . '<br><br>';
		}
	}
	
	else
	{
		$message .= "This customer already exists. Please check your info again. <br><br>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="general.css">
	</head>
	<body>
		<div id="createCustomer">
			<br>
			<?php echo $message; ?>
			<form name="form" action="redirectCreateCustomer.php" method="POST">
				<input type="submit" value="Go back to create customer page"/>	
			</form>
		</div>
		<footer class="footer-distributed">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <div class="footer-left">
                <h3>DJ Lim's Cinematography</h3>
                <p class="footer-company-name">Lim Photography © 2018</p>
                <div class="footer-icons">
                    <a href="https://www.facebook.com/elizabethlimphoto/"><i class="fa fa-facebook"></i></a>
                    <a href="https://www.youtube.com/channel/UCjGWC3N0DibPnIhQtYDgONg"><i class="fa fa-youtube"></i></a>
                    <a href="https://www.instagram.com/elizabethlimphotography/"><i class="fa fa-instagram"></i></a>
                    <a href="https://elizabethkaylim.com"><i class="fa fa-share-alt"></i></a>
                </div>
            </div>
            <br><br>
        </footer>
	</body>
</html>
