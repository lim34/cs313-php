<?php

	session_start();

	header("refresh:0, url=header2.php");

	if(!isset($_SESSION["items"]) or empty($_SESSION["items"]))
	//or is_array($_SESION["items"])) {
	{
		$_SESSION["items"] = array();
	}
	
	$items = $_POST["items"];
	
	foreach ($items as $item) {
		array_push($_SESSION["items"], $item);
	}
	
?>