<?php

	session_start();
	
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
  
  		//$user = 'Lim';
  		//$password = 'Dlaehd123';
  		//$db = new PDO('pgsql:host=localhost;dbname=photography', $user, $password);
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
		$message1 = "* You must enter all input values in order to update.* <br>";
		$message1 .= "* For info that doesn't need to be updated, type the same value.* <br>";
		foreach($rows as $row)
		{
			$message1 .= "Welcome, " . $row['firstname'] . " " . $row['lastname'] . "<br>";
		}
		$message2 .= 'What information would you like to update?';
		$message2 .= '<form name="form" action="updateCustomer2.php" method="POST">';
		$message2 .= 'First Name: <input type="text"" name="firstName2" required="required"><br><br>';
		$message2 .= 'Last Name:  <input type="text" name="lastName2" required="required"><br><br>';
		$message2 .= 'Phone Number: <input type="text" name="phoneNumber2" placeholder="xxx-xxx-xxxx" required="required"><br><br>';
		$message2 .= 'Email Address: <input type="text" name="email2" required="required"><br><br>';
		$message2 .= '<input type="submit" value="Submit the form" name="submitButton"/>';
		$message2 .= '</form><br><br>';
	}
	
	else
	{
		echo "There's no customer that matches the information you provided. Please check your info again.<br><br>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="general.css">
		<title>DJ's Cinematography Website</title>
	</head>
	<body>
		<div id="updateCustomer">
			<br>
			<?php echo $message1; echo $message2 ?>
			<form name="form" action="redirectUpdateCustomer.php" method="POST">
				<input type="submit" value="Go back to update customer page"/>	
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