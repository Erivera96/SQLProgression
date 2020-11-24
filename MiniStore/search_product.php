<html>

<form name="input" action="customer_logout.php" method="post">
	<input type="submit" value="Customer Logout">	
</form>

	<?php
		include 'db_2020f.php';
		
		$search_product = "product";
		$valid = True;

		if(!isset($_POST[$search_product]) or empty($_POST[$search_product]))
		{
			$valid = False;
			echo "Error: Didn't supply ".$search_product.".<br>";
			exit();
		}

		$cookie_name = "cus_search_history";
		$cookie_value = $_POST[$search_product];
		$cookie = setcookie($cookie_name, $cookie_value, time()+432000,"/");
		

		if(strcmp($_POST[$search_product], "*") == 0)
		{
			echo "<caption>Available product list for search <b>ALL</caption>";
			$_POST[$search_product] = "";
		}
		else
		{
			echo "<caption>Available product list for search <b> ".$_POST[$search_product]."</caption>";
		}

		$sql = "select p.name as product_name, p.id as product_id, p.description as description, p.sell_price as sell_price, p.quantity as available_quantity, v.name as vendor_name from PRODUCT as p join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id where p.name like '%".$_POST[$search_product]."%'";
		
		$result = mysqli_query($conn, $sql);
		echo "<form name='input' action='customer_order.php' method='post'>";
		echo "<table border='1'>
				<tr>
					<th>Product Name</th>
					<th>Description</th>
					<th>Sell price</th>
					<th>Available quantity</th>
					<th>Order quantity</th>
					<th>Vendor name</th>
				</tr>";
		$index = 0;	
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$row['product_name']."<input type='hidden' name='product".strval($index)."' value='".$row['product_id']."'></td>";
			echo "<td>".$row['description']."</td>";
			echo "<td>".$row['sell_price']."</td>";
			echo "<td>".$row['available_quantity']."</td>";
			echo "<td><input type='text' name='Order".strval($index)."_quantity' value=''></td>";
			echo "<td>".$row['vendor_name']."</td>";
			$index = $index + 1;
		}
		echo "<input type='hidden' name='possible_orders' value='".$index."'>";
		echo "</table>";
		echo "<input type='submit' value='Place Order'>";
		echo "</form>";	
		mysqli_close($conn);
	?>
<form name="input" action="customer_check_p2.php" method="post">
	<input type="submit" value="Customer Homepage">	
</form>

<form name="input" action="phase2.html" method="post">
	<input type="submit" value="Phase2 Homepage">	
</form>

</html>
