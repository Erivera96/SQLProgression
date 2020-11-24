<html>
	<title>Employee Homepage</title>
	<?php	

		$cookie_name = "emp_loginId";
		if(!isset($_COOKIE[$cookie_name])) 
		{	
			echo "You are not logged in as an employee!\n";
			echo "Please login to view employee homepage.";

			echo "
				<br>
				<form name='input' action='employee_login.html' method='post'>
					<input type='submit' value='Employee Login'>	
					</form>
				<br>
				<form name='input' action='phase2.html' method='post'>
					<input type='submit' value='Phase2 Homepage'>	
					</form>
				";
			exit();
		}

		include 'db_cps5740.php';
		$sql = "select login, name, role from EMPLOYEE2";
		$result = mysqli_query($conn, $sql);
		
		$name = "";
		$role = "";

		while($row = mysqli_fetch_array($result))
		{
			if(strcasecmp($row['login'], $_COOKIE[$cookie_name]) == 0)
			{
				$name = $row['name'];
				if(strcmp('M', $row['role']) == 0)
				{
					$role = "manager";
				}
				else
				{
					$role = "employee";
				}
			}
		}

		echo "Welcome " . $role . ": " . $name . "\n";
		
		echo "
		<form name='input' action='employee_logout.php' method='post'>
			<input type='submit' value='Logout'>	
		</form>
		
		<br>	
		
		<form name='input' action='add_product.php' method='post'>
			<input type='submit' value='Add product'>	
		</form>
		
		<form name='input' action='employee_search_product.php' method='post'>
			<input type='submit' value='Search and update product'>	
		</form>
		
		<form name='input' action='employee_view_vendors.php' method='post'>
			<input type='submit' value='View vendors'>	
		</form>

		<br> 
		";	
		
		if(strcmp("employee", $role) == 0)
		{
			echo "
				<form name='input' action='phase2.html' method='post'>
					<input type='submit' value='Phase2 Homepage'>	
				</form>
				";
			exit();
		}
			
		/*
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
		}*/			
	?>

<form name="input" action="manager_view_reports.php" method="post">
<caption> View reports - period: </caption>
<select name="period" id="period">
	<option value="all">all</option>
	<option value="past week">past week</option>
	<option value="current month">current month</option>
	<option value="past month">past month</option> 
</select>
<caption>, by: </caption>
<select name="by" id="by">
	<option value="all sales">all sales</option>
	<option value="products">products</option>
	<option value="vendors">vendors</option>
</select>
<input type="submit" value="Submit">
</form>

<br>
<form name="input" action="phase2.html" method="post">
	<input type="submit" value="Phase2 Homepage">	
</form>

</html>
