<html>
<?php
	include 'db_cps5740.php';

	$result = mysqli_query($conn,"SELECT * FROM VENDOR");

	echo "<table border='1'>
		<caption>The following vendors are in the database.</caption>
		<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Address</th>
		<th>City</th>
		<th>State</th>
		<th>Zipcode</th>
		<th>Location(Latitude,Longitude)</th>
		</tr>
		";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['vendor_id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['city'] . "</td>";
		echo "<td>" . $row['state'] . "</td>";
		echo "<td>" . $row['zipcode'] . "</td>";
		echo "<td>" . '(' . $row['latitude'] . ',' . $row['Longitude'] . ')' . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	mysqli_close($conn);
?>
<form name='input' action='employee_homepage.php' method='post'>
	<input type='submit' value='Employee Homepage'>	
</form>
<form name='input' action='phase2.html' method='post'>
	<input type='submit' value='Phase2 Homepage'>	
</form>

</html>
