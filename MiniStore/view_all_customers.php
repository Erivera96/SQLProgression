<html>
	<title>All Employees</title>
	
	<?php
		$cookie_name = "emp_loginId";
		if(!isset($_COOKIE[$cookie_name])) 
		{	 
			echo "You are not logged in as a manager/employee! Please log in to view customers.";
			echo "<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>	
			      </form>";
			exit();
		}

		include 'db_2020f.php';
 	
		$sql = "select * from CUSTOMER";
		
		$result = mysqli_query($conn, $sql);
		
		echo "<table border='1'>
				<tr>
					<caption>The following customers are in the database</caption>
					<th>customer_id</th>
					<th>login_id</th>
					<th>password</th>
					<th>first_name</th>
					<th>last_name</th>
					<th>TEL</th>
					<th>address</th>
					<th>city</th>
					<th>zipcode</th>
					<th>state</th>
				</tr>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>" . $row['customer_id'] . "</td>";			
			echo "<td>" . $row['login_id'] . "</td>";			
			echo "<td>" . $row['password'] . "</td>";			
			echo "<td>" . $row['first_name'] . "</td>";			
			echo "<td>" . $row['last_name'] . "</td>";			
			echo "<td>" . $row['TEL'] . "</td>";			
			echo "<td>" . $row['address'] . "</td>";			
			echo "<td>" . $row['city'] . "</td>";			
			echo "<td>" . $row['zipcode'] . "</td>";			
			echo "<td>" . $row['state'] . "</td>";			
		}
		echo "</table>";		
		mysqli_close($conn);
	?>

	<form name="input" action="phase2.html" method="post">
		<input type="submit" value="Phase2 Homepage">	
	</form>
</html>
