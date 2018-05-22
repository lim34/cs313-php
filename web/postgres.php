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
