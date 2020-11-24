<html>
<?php
	$po = $_POST['possible_orders']; // possible orders
	
	$valid_orders = True;
	$index = 0;
	while($index < $po)
	{
		$order = 'Order'.strval($index).'_quantity';
		if(intval($_POST[$order]) < 0)
		{
			$valid_orders = False;
			break;
		}
		$index += 1;
	}

	if(!$valid_orders)
	{
		echo "Whoops! Looks like at least one of your orders wasn't valid!<br>";
		echo "You entered a value less than 0 for order quantity.<br>";
		echo "Program will exit.<br>";
		echo "
			<form name='input' action='customer_check_p2.php' method='post'>
				<input type='submit' value='Customer Homepage'>
			</form>
			<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>
			</form>
			";
		exit();
	}	

	include 'db_2020f.php';
	$sql = 'select id, name, quantity from PRODUCT';
	$result = mysqli_query($conn, $sql);
	
	$insufficient_orders = array();
	$sufficient_orders = array();
	while($row = mysqli_fetch_array($result))
	{	
		$index = 0;
		while($index < $po)
		{
			$order = 'Order'.strval($index).'_quantity';
			$product = 'product'.strval($index);
			if($row['id'] == $_POST[$product])
			{
				if($row['quantity'] < intval($_POST[$order]))
				{
					$insufficient_orders [] = $row['name'];
				}
				else
				{
					$sufficient_orders [] = $index;
				}
			}
			$index += 1;
		}
	}

	if(!empty($insufficient_orders))
	{
		$index = 0;
		while($index < count($insufficient_orders))
		{
			echo "Sorry, not enough quantity for: ". $insufficient_orders[$index]."<br>";
			$index += 1;
		}
		echo "<br>This order did not go through.<br>
			<form name='input' action='customer_check_p2.php' method='post'>
				<input type='submit' value='Customer Homepage'>
			</form>
			<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>
			</form>
			";
		exit();
	}

	$cookie_name = "cus_loginId";
	$customer_id = $_COOKIE[$cookie_name];
	$sql = "select * from CUSTOMER where login_id like '".$_COOKIE[$cookie_name]."'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result))
	{
		$customer_id = $row['customer_id'];
	}

	$success = False;
	$index = 0;
	while($index < count($sufficient_orders))
	{
		$order = 'Order'.strval($sufficient_orders[$index]).'_quantity';
		$product = 'product'.strval($sufficient_orders[$index]);
		
		$sql = "select quantity from PRODUCT where id = ".$_POST[$product];
		$result = mysqli_query($conn, $sql);
		$available = 0;
		while($row = mysqli_fetch_array($result))
		{
			$available = $row['quantity'];
		}
		$updated_quantity = $available - intval($_POST[$order]);
		
		$update_sql = "update PRODUCT set quantity = ".$updated_quantity." where id = ".$_POST[$product];
		$insert_sql = "insert into ORDERS values (null,".$customer_id.",current_timestamp())";

		if(($conn->query($update_sql) === TRUE) && ($conn->query($insert_sql) === TRUE))
		{
			$sql = "select max(id) as max_id, date from ORDERS where customer_id = ".$customer_id;
			$result = mysqli_query($conn, $sql);
			$order_id = 0;
			while($row = mysqli_fetch_array($result))
			{
				$order_id = $row['max_id'];
			}
			$insert2_sql = "insert into PRODUCT_ORDER values (".$order_id.",".$_POST[$product].",".$_POST[$order].")";

			if($conn->query($insert2_sql) === TRUE)
			{
				$success = True;
			}
		}
		else
		{
			$success = False;
			break;
		}
		$index += 1;
	}

	if(!$success)
	{
		echo "Looks like something went wrong and your order could not be processed.<br>";
		echo "Error: Order <b>NOT</b> successfull<br>";
		echo "Program will exit.";
		echo "
			<form name='input' action='customer_check_p2.php' method='post'>
				<input type='submit' value='Customer Homepage'>
			</form>
			<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>
			</form>
			";
		exit();
	}
	else
	{
		echo "Order was sucessful!";
		echo "
			<form name='input' action='customer_check_p2.php' method='post'>
				<input type='submit' value='Customer Homepage'>
			</form>
			<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>
			</form>
			";
	}
?>
</html>
