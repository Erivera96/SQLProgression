<html>

<form name="input" action="employee_logout.php" method="post">
	<input type="submit" value="Logout">	
</form>

<br>

<caption> <b> Add Products </b> </caption>
	
	<form name="input" action="employee_insert_product.php" method="post" >
		<br> Product Name: <input type="text" name="name">
		<br> Description: <input type="text" name="description">
		<br> Cost: <input type="text" name="cost">
		<br> Sell Price: <input type="text" name="sell_price">
		<br> Quantity: <input type="text" name="quantity">
		<br> <label for="vendor">Select vendor:</label>	
		<select name="vendor" id="vendor">
		<?php
			include 'db_cps5740.php';

			$sql = "select * from VENDOR";
			$result = mysqli_query($conn, $sql);
			
			while($row = $result -> fetch_assoc())
			{
				$name = $row['name'];
				$vendor_id = $row['vendor_id'];
				echo '<option value="'.$vendor_id.'">'.$name.'</option>';
			}
		?>	
		</select>

		<input type="submit" value="Submit">
	</form>

	<form name="input" action="phase2.html" method="post">
		<input type="submit" value="Phase2 Homepage">	
	</form>
</html>
