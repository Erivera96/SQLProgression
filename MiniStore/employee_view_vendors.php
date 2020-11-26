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
	$result = mysqli_query($conn,"SELECT * FROM VENDOR");

echo '
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrmJjh1AveghA62RvRdNXtULNYda3wrLc&callback=initMap&libraries=&v=weekly" defer> </script>

	<style type="text/css">
		#map { height: 400px; width: 100%; }
	</style>
	
	<script>
		function initMap() {';

	echo 'const map = new google.maps.Map(document.getElementById("map"), { zoom : 4, center : {lat: 37.8, lng: -96}});';
	echo 'const markers = [];';
	while($row = mysqli_fetch_array($result))
	{	
		echo '
		markers.push(new google.maps.Marker({ position: { lat: '.$row['latitude'].', lng: '.$row['Longitude'].' }, label: String('. strval($row['vendor_id']).'), }));';
		echo 'markers[markers.length-1].setMap(map);';
	}
     		echo'}
	</script>
    	<!--The div element for the map -->
    	<div id="map"></div>
  ';
?>
<form name='input' action='employee_homepage.php' method='post'>
	<input type='submit' value='Employee Homepage'>	
</form>
<form name='input' action='phase2.html' method='post'>
	<input type='submit' value='Phase2 Homepage'>	
</form>
</html>
