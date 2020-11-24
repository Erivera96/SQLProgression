<html>
	<?php
		
		$cookie_name = "cus_loginId";
		if(!isset($_COOKIE[$cookie_name])) 
		{	 
			echo "You are not logged in as a customer! Please log in to update your data.";
			echo "<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>	
			      </form>";
			exit();
		}
			
		include 'db_2020f.php';
 	
		$sql = "select * from CUSTOMER where login_id = '$_COOKIE[cus_loginId]'";
		
		$result = mysqli_query($conn, $sql);
		echo "<caption><b> Update Customer Information </b></caption>";	
		echo "<form name='input' action='update_customer.php' method='post' >";
		echo "<table border='1'>
				<tr>
					<th>Customer_Id</th>
					<th>login_ID</th>
					<th>password</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Tel</th>
					<th>Address</th>
					<th>City</th>
					<th>Zipcode</th>
					<th>State</th>
				</tr>";
		
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>" . $row['customer_id'] . "</td>";			
			echo "<td>" . $row['login_id'] . "</td>";			
			echo "<td> <input type='text' name='password' value='" . $row['password'] . "'> </td>";
			echo "<td> <input type='text' name='first_name' value='" . $row['first_name'] . "'></td>";
			echo "<td> <input type='text' name='last_name' value='" . $row['last_name'] . "'></td>";
			echo "<td> <input type='text' name='TEL' value='" . $row['TEL'] . "'></td>";
			echo "<td> <input type='text' name='address' value='" . $row['address'] . "'></td>";
			echo "<td> <input type='text' name='city' value='" . $row['city'] . "'></td>";
			echo "<td> <input type='text' name='zipcode' value='" . $row['zipcode'] . "'></td>";
			echo "<td>";
			echo "<select name='state' id='state'>".
				"<option value='".$row['state']."'>".ucfirst($row['state'])."</option>".
				"<option value='alabama'>Alabama</option>".
				"<option value='alaska'>Alaska</option>".
				"<option value='arizona'>Arizona</option>".
				"<option value='arkansas'>Arkansas</option>".
				"<option value='california'>California</option>".
				"<option value='colorado'>Colorado</option>".
				"<option value='connecticut'>Connecticut</option>".
				"<option value='delaware'>Delaware</option>".
				"<option value='florida'>Florida</option>".
				"<option value='georgia'>Georgia</option>".
				"<option value='hawaii'>Hawaii</option>".
				"<option value='idaho'>Idaho</option>".
				"<option value='illinois'>Illinois</option>".
				"<option value='indiana'>Indiana</option>".
				"<option value='iowa'>Iowa</option>".
				"<option value='kansas'>Kansas</option>".
				"<option value='kentucky'>Kentucky</option>".
				"<option value='louisiana'>Louisiana</option>".
				"<option value='maine'>Maine</option>".
				"<option value='maryland'>Maryland</option>".
				"<option value='massachusetts'>Massachusetts</option>".
				"<option value='michigan'>Michigan</option>".
				"<option value='minnesota'>Minnesota</option>".
				"<option value='mississippi'>Mississippi</option>".
				"<option value='missouri'>Missouri</option>".
				"<option value='montana'>Montana</option>".
				"<option value='nebraska'>Nebraska</option>".
				"<option value='nevada'>Nevada</option>".
				"<option value='new hampshire'>New Hampshire</option>".
				"<option value='new jersey'>New Jersey</option>".
				"<option value='new mexico'>New Mexico</option>".
				"<option value='new york'>New York</option>".
				"<option value='north carolina'>North Carolina</option>".
				"<option value='north dakota'>North Dakota</option>".
				"<option value='ohio'>Ohio</option>".
				"<option value='oklahoma'>Oklahoma</option>".
				"<option value='oregon'>Oregon</option>".
				"<option value='pennsylvania'>Pennsylvania</option>".
				"<option value='rhode island'>Rhode Island</option>".
				"<option value='south carolina'>South Carolina</option>".
				"<option value='south dakota'>South Dakota</option>".
				"<option value='tennessee'>Tennessee</option>".
				"<option value='texas'>Texas</option>".
				"<option value='utah'>Utah</option>".
				"<option value='vermont'>Vermont</option>".
				"<option value='virginia'>Virginia</option>".
				"<option value='washington'>Washington</option>".
				"<option value='west virginia'>West Virginia</option>".
				"<option value='wisconsin'>Wisconsin</option>".
				"<option value='wyoming'>Wyoming</option>".
			"</select>".
			"</td> </tr>";
		}
		echo "</table>";
		echo "<input type='submit' value='Update Information'/>";
		echo "</form>"; 
	?>
	<form name="input" action="phase2.html" method="post">
		<input type="submit" value="Phase2 Homepage">	
	</form>
</html>
