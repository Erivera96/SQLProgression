<?php
	
	$servername = "imc.kean.edu";
	$username = "emrivera";
	$password = "0990519";
	$dbname = "CPS5740";

	$conn = new mysqli($servername, $username, $password, $dbname);
		
	if($conn -> connect_error)
	{
		die("Connection Failed: " . $conn -> connect_error);
	}
?>
