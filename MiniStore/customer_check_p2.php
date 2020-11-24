<html>
	<?php		
		$cookie_name = "cus_loginId";
		if(!isset($_COOKIE[$cookie_name])) 
		{	
			echo "You are not logged in as a customer!\n";
			echo "Please login to view customer homepage.";

			echo "
				<br>
				<form name='input' action='customer_login.html' method='post'>
					<input type='submit' value='Customer Login'>	
					</form>
				<br>
				<form name='input' action='phase2.html' method='post'>
					<input type='submit' value='Phase2 Homepage'>	
					</form>
				";
			exit();
		}

		include 'db_2020f.php';
					
		$sql = "select login_id, password, first_name, last_name, address, city, state, zipcode from CUSTOMER";
		$result = mysqli_query($conn, $sql);
		$name = "";
		$address = "";
		
		while($row = mysqli_fetch_array($result))
		{
			if((strcasecmp($row['login_id'], $_COOKIE[$cookie_name]) == 0))
			{
				$name = $row['first_name'] . " " . $row['last_name'];
				$address = $row['address'] . ", ". $row['city'] . ", " . $row['state'] . " " . $row['zipcode'];
			}
		}
				
		echo "Welcome customer: <b>" . $name . "</b><br>";
		echo $address;
		
		$ip = $_SERVER['REMOTE_ADDR'];
		echo "<br>Your IP address: " . $ip;
		
		$ip_subnet = explode(".", $ip);
		if($ip_subnet[0] == "131" && $ip_subnet[1] == "125")
		{
			echo "<br>You are from Kean Univeristy.";
		}
		else
		{
			echo "<br>You are NOT from Kean University.";
		}	
		echo "
			<br>
			<form name='input' action='customer_logout.php' method='post'>
				<input type='submit' value='Customer Logout'>	
			</form>
			<br>

			<form name='input' action='customer_update_page.php' method='post'>
				<input type='submit' value='Update My Data'>	
			</form>
			<form name='input' action='customer_order_history.php' method='post'>
				<input type='submit' value='View Order History'>
			</form>
			<form name='input' action='search_product.php' method='post'>
				<caption>search product (* for all)</caption>
				<br>
				<input type='text' name='product'>
				<input type='submit' value='Search'>
			</form>
			<br>
			";
		
		$cookie_name = "cus_search_history";
		$has_search_history = True;

		if(!isset($_COOKIE[$cookie_name]))
		{
			$has_search_history = False;
		}

		include 'db_cps5740.php';
		$in_ads = False;
		if($has_search_history)
		{
			$sql = "select category from Advertisement";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result))
			{
				if(strpos(strtolower($_COOKIE[$cookie_name]), strtolower($row['category'])) !== False)
				{
					$in_ads = True;
					break;
				}
			}
		}	

		$sql = "select category, image, description, url from Advertisement";
		$result = mysqli_query($conn, $sql);

		while($row = mysqli_fetch_array($result))
		{
			if(!$has_search_history || !$in_ads) 
			{
				if(strcmp("OTHER", $row['category']) == 0)
				{	
					echo "<img src='data:image/png;base64,". base64_encode($row['image']) ."' alt='".$row['url']."'/>";
					echo "<br> <caption>".$row['description']."</caption> <br>";
				}	
			}
			else
			{
				if(strpos(strtolower($_COOKIE[$cookie_name]), strtolower($row['category'])) !== False)
				{
					echo "<img src='data:image/png;base64,". base64_encode($row['image']) ."' alt='".$row['url']."'/>";
					echo "<br> <caption>".$row['description']."</caption> <br>";
				}
			}
		}
	?>
	<br>
	<form name='input' action='phase2.html' method='post'>
		<input type='submit' value='Phase2 Homepage'>	
	</form>
</html>
