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
		echo 'Session: ' . $row['sessionname'] . '<br/>';
		if ($row['isavailable'] == 1)
		{
			echo 'Availability: Available <br/>';
  		}
  		else
  		{
  			echo 'Availability: Not Available <br/>';
  		}
  		echo ' Quantitiy: ' . $row['quantity'] . '<br/>';
  		echo ' Description: ' . $row['description'] . '<br/>';
  		echo ' Price: $' . $row['price'] . '.00<br/>';
  		echo '<br/>';
  	}
?>
