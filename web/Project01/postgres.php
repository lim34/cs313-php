<?php
	try
	{
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
	
	$sessionName = $_POST['sessionName'];
	//$parsedName = '\'' . $sessionName . '\'';
	$stmt = $db->prepare('SELECT s.isAvailable, s.quantity, s.sessionname, p.description, p.price FROM session s
	inner join price p ON p.sessionId = s.IDEN WHERE s.sessionname = :name');
	$stmt->bindValue(':name', $sessionName);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($rows as $row)
	{
		$message = '<p id="info">Session: ' . $row['sessionname'] . '<br/><br>';
		if ($row['isavailable'] == 1)
		{
			$message .= 'Availability: Available <br/><br>';
  		}
  		else
  		{
  			$message .= 'Availability: Not Available <br/><br>';
  		}
  		$message .= ' Quantitiy: ' . $row['quantity'] . '<br/><br>';
  		$message .= ' Description: ' . $row['description'] . '<br/><br>';
  		$message .= ' Price: $' . $row['price'] . '.00<br/><br>';
  		$message .= '<br/><br></p>';
  	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="general.css">
		<title>DJ's Cinematography Website</title>
	</head>
	<body>
		<div id="sessionInfo">
			<br>
			<?php echo $message; ?>
			<form name="form" action="redirectSessionInfo.php" method="POST">
				<input type="submit" value="Go back to Session Info Page"/>	
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