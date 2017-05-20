<?php

$dbUser = 'djlim';
$dbPassword = 'djlim';
$dbName = 'climbing';
$dbHost = 'localhost';
$dbPort = '5433';

try
{
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Climbers List</title>
</head>

<body>
<h1>Climbers of the World</h1>

<?php

$statement = $db->prepare("SELECT LastName, FirstName, Gender, OriginID, DifficultyID, Description FROM Climbers;");
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	// The variable "row" now holds the complete record for that
	// row, and we can access the different values based on their
	// name
	echo '<p>';
	echo '<strong>' . $row['FirstName'] . ' ' . $row['LastName'] . ':' . '</strong>';
	echo $row['Gender'] . ', Origin ID: ' . $row['OriginID'] . ', Difficulty ID: ' . $row['DifficultyID'] . ', Description: ' . $row['Description'];
	echo '</p>';
}

?>

</body>
</html>