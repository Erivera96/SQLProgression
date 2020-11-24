<html>
	<title>All Employees</title>
	
	<?php
		include 'db_cps5740.php';
 	
		$sql = "select * from EMPLOYEE2";
		
		$result = mysqli_query($conn, $sql);
		
		echo "<table border='1'>
				<tr>
					<caption>The following employees are in the database</caption>
					<th>employee_id</th>
					<th>login</th>
					<th>password</th>
					<th>name</th>
					<th>role</th>
				</tr>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>" . $row['employee_id'] . "</td>";			
			echo "<td>" . $row['login'] . "</td>";			
			echo "<td>" . $row['password'] . "</td>";			
			echo "<td>" . $row['name'] . "</td>";			
			echo "<td>" . $row['role'] . "</td>";			
		}
		echo "</table>";		
		mysqli_close($conn);
	?>

	<form name="input" action="phase2.html" method="post">
		<input type="submit" value="Phase2 Homepage">	
	</form>
</html>
