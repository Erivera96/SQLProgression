<html>
<?php
	include 'db_2020f.php'

	$result = mysqli_query($conn,"SELECT * from CUSTOMER");

	$customer_id = "";
	while($row = mysqli_fetch_array($result))
	{
		if (strcasecmp($row['login_id'],$_COOKIE['cus_loginId']) == 0)
		{
			$customer_id = $row['customer_id'];
			break;
		}
	}

	$sql_orderids = "select distinct(o.id),'dummy' from ORDERS as o join CUSTOMER as c on c.customer_id = o.customer_id and c.customer_id = " . $customer_id;

	echo "Your order history:<br>";
	$result = mysqli_query($con,$sql_orderids);
	while($row = mysqli_fetch_array($result))
	{
		$order_id = $row['id'];

		$sql = "select o.id as 'Order ID', p.name as 'Product Name', po.quantity as 'Order Quantity',
			p.sell_price as 'Unit Price', p.sell_price*po.quantity as 'Sub Total', o.date as 'Order Date'
			from PRODUCT_ORDER as po join PRODUCT as p on p.id = po.product_id join ORDERS as o on o.id = po.order_id
			join CUSTOMER as c on c.customer_id = o.customer_id and o.customer_id = " . $customer_id . " where o.id = " . $order_id . " union select null as 'ORDER ID', 'order paid' as 'Product Name', null as 'Order Quantity', null as 'Unit Price', sum(p.sell_price*po.quantity) as 'Sub Total', null as 'Order Date' from PRODUCT_ORDER as po join PRODUCT as p on p.id = po.product_id join ORDERS as o on o.id = po.order_id join CUSTOMER as c on c.customer_id = o.customer_id and o.customer_id = " . $customer_id . " where o.id = " . $order_id;
		
		$result_table = mysqli_query($con,$sql);

		echo "<table border='1'>
			<tr>
			<th>Order ID</th>
			<th>Product Name</th>
			<th>Order Quantity</th>
			<th>Unit Price</th>
			<th>Sub Total</th>
			<th>Order Date</th>
			</tr>
			";

		while($row_table = mysqli_fetch_array($result_table))
		{
			echo "<tr>";
			echo "<td>" . $row_table['Order ID'] . "</td>";
			echo "<td>" . $row_table['Product Name'] . "</td>";
			echo "<td>" . $row_table['Order Quantity'] . "</td>";
			echo "<td>" . $row_table['Unit Price'] . "</td>";
			echo "<td>" . $row_table['Sub Total'] . "</td>";
			echo "<td>" . $row_table['Order Date'] . "</td>";
			echo "</tr>";
		}
		echo "</table>
			<br>";
	}

	$sql_total = "select sum(p.sell_price*po.quantity) as 'Total', 'dummy' from PRODUCT_ORDER as po join PRODUCT as p on p.id = po.product_id join ORDERS as o on o.id = po.order_id join CUSTOMER as c on c.customer_id = o.customer_id and o.customer_id = " . $customer_id;
	
	$result_total = mysqli_query($conn,$sql_total);
	$total = 0;
	
	while($row_total = mysqli_fetch_array($result_total))
	{
		$total = $row_total['Total'];
	}
	
	echo "<table border='1'>
		<tr>
		<td>Total paid</td>
		<td>$total</td>
		</tr>
		</table>
		";

	mysqli_close($conn);
?>

<form name='input' action='customer_check_p2.php' method='post'>
	<input type='submit' value='Customer Homepage'>	
</form>
<form name='input' action='phase2.html' method='post'>
	<input type='submit' value='Phase2 Homepage'>	
</form>
</html>
