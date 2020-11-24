<?php
	
	$servername = "imc.kean.edu";
	$username = "emrivera";
	$password = "0990519";
	$dbname = "2020F_emrivera";

	$conn = new mysqli($servername, $username, $password, $dbname);
		
	if($conn -> connect_error)
	{
		die("Connection Failed: " . $conn -> connect_error);
	}
?>
