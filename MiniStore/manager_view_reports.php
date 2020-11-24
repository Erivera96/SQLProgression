<html>
<?php

	$where_condition = "True";
	if(strcasecmp($_POST['period'],'past month') == 0)
	{	
		$where_condition = "o.date >= date_sub(current_timestamp(),interval 30 day)";

	}
	else if(strcasecmp($_POST['period'],'past week') == 0)
	{
		$where_condition = "o.date >= date_sub(current_timestamp(),interval 7 day)";

	}
	else if(strcasecmp($_POST['period'],'current month') == 0)
	{
		$where_condition = "month(o.date) = month(curdate())";
	}

	if(strcasecmp($_POST['by'],'all sales') == 0)
	{
		$sql = "select p.name as 'Product Name', v.name as 'Vendor Name', p.cost as 'Unit Cost', p.quantity as 'Current Quantity', po.quantity as 'Sold Quantity', p.sell_price as 'Sold Unit Price', p.sell_price*po.quantity as 'Sub Total', p.sell_price*po.quantity - po.quantity*p.cost as 'Profit', concat(c.first_name,' ',c.last_name) as 'Customer Name', o.date as 'Order Date' from PRODUCT_ORDER as po join  PRODUCT as p on po.product_id = p.id join ORDERS as o on po.order_id = o.id join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id join  CUSTOMER as c on o.customer_id = c.customer_id where " . $where_condition . " union select null as 'Product Name', null as 'Vendor Name', null as 'Unit Cost', null as 'Current Quantity', null as 'Sold Quantity', null as 'Sold Unit Price', sum(p.sell_price*po.quantity) as 'Sub Total', sum(p.sell_price*po.quantity - po.quantity*p.cost) as 'Profit', null as 'Customer Name', null as 'Order Date' from PRODUCT_ORDER as po join PRODUCT as p on po.product_id = p.id join ORDERS as o on po.order_id = o.id where " . $where_condition;
		
		include 'db_2020f.php';
		
		$result = mysqli_query($conn,$sql);
		echo "<table border='1'>
			Report by <b>" . $_POST['by'] . " </b> during period <b> " . $_POST['period'] . " </b> 
			<tr>
			<th>#</th>
			<th>Product Name</th>
			<th>Vendor Name</th>
			<th>Unit Cost</th>
			<th>Current Quantity</th>
			<th>Sold Quantity</th>
			<th>Sold Unit Price</th>
			<th>Sub Total</th>
			<th>Profit</th>
			<th>Customer Name</th>
			<th>Order Date</th>
			</tr>
			";

		$idx = 1;
		$cap = mysqli_num_rows($result);
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			if($idx == $cap)
			{
				echo "<td>Total</td>";
			}
			else
			{
				echo "<td>" . strval($idx) . "</td>";
			}	
			echo "<td>" . $row['Product Name'] . "</td>";
			echo "<td>" . $row['Vendor Name'] . "</td>";
			echo "<td>" . $row['Unit Cost'] . "</td>";
			echo "<td>" . $row['Current Quantity'] . "</td>";
			echo "<td>" . $row['Sold Quantity'] . "</td>";
			echo "<td>" . $row['Sold Unit Price'] . "</td>";
			echo "<td>" . $row['Sub Total'] . "</td>";
			echo "<td>" . $row['Profit'] . "</td>";
			echo "<td>" . $row['Customer Name'] . "</td>";
			echo "<td>" . $row['Order Date'] . "</td>";
			echo "</tr>";
			$idx += 1;
		}
		echo "</table>";
	}
	else if(strcasecmp($_POST['by'],'products') == 0)
	{
		$sql = "select p.name as 'Product Name', v.name as 'Vendor Name', avg(p.cost) as 'Avg Unit Cost', p.quantity as 'Current Quantity', sum(po.quantity) as 'Sold Quantity', avg(p.sell_price) as 'Avg Sold Unit Price', sum(p.sell_price*po.quantity) as 'Sub Total', sum(p.sell_price*po.quantity - po.quantity*p.cost) as 'Profit' from PRODUCT_ORDER as po join PRODUCT as p on po.product_id = p.id join ORDERS as o on po.order_id = o.id join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id where " . $where_condition . " group by p.id union select null as 'Product Name', null as 'Vendor Name', null as 'Avg Unit Cost', null as 'Current Quantity', null as 'Sold Quantity', null as 'Avg Sold Unit Price', sum(p.sell_price*po.quantity) as 'Sub Total', sum(p.sell_price*po.quantity - po.quantity*p.cost) as 'Profit' from PRODUCT_ORDER as po join PRODUCT as p on po.product_id = p.id join ORDERS as o on po.order_id = o.id where " . $where_condition;
		
		include 'db_2020f.php';

		$result = mysqli_query($conn,$sql);
		echo "<table border='1'>
			Report by <b>" . $_POST['by'] . " </b> during period <b> " . $_POST['period'] . " </b> 
			<tr>
			<th>#</th>
			<th>Product Name</th>
			<th>Vendor Name</th>
			<th>Avg Unit Cost</th>
			<th>Current Quantity</th>
			<th>Sold Quantity</th>
			<th>Avg Sold Unit Price</th>
			<th>Sub Total</th>
			<th>Profit</th>
			</tr>
			";

		$idx = 1;
		$cap = mysqli_num_rows($result);
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			if($idx == $cap)
			{
				echo "<td>Total</td>";
			}
			else
			{
				echo "<td>" . strval($idx) . "</td>";
			}	
			echo "<td>" . $row['Product Name'] . "</td>";
			echo "<td>" . $row['Vendor Name'] . "</td>";
			echo "<td>" . $row['Avg Unit Cost'] . "</td>";
			echo "<td>" . $row['Current Quantity'] . "</td>";
			echo "<td>" . $row['Sold Quantity'] . "</td>";
			echo "<td>" . $row['Avg Sold Unit Price'] . "</td>";
			echo "<td>" . $row['Sub Total'] . "</td>";
			echo "<td>" . $row['Profit'] . "</td>";
			echo "</tr>";
			$idx += 1;
		}
		echo "</table>";
	}
	else
	{
		$sql = "select v.name as 'Vendor Name', p.quantity as 'Quantity in Stock', sum(po.quantity*p.cost) as 'Amount to Vendor', sum(po.quantity) as 'Sold Quantity', sum(p.sell_price*po.quantity) as 'Sub Total Sale', sum(p.sell_price*po.quantity - po.quantity*p.cost) as 'Profit' from PRODUCT_ORDER as po join PRODUCT as p on po.product_id = p.id join ORDERS as o on po.order_id = o.id join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id where " . $where_condition . " group by v.vendor_id union select null as 'Vendor Name', null as 'Quantity in Stock', sum(po.quantity*p.cost) as 'Amount to Vendor', null as 'Sold Quantity', sum(p.sell_price*po.quantity) as 'Sub Total Sale', sum(p.sell_price*po.quantity - po.quantity*p.cost) as 'Profit' from PRODUCT_ORDER as po join PRODUCT as p on po.product_id = p.id join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id join ORDERS as o on po.order_id = o.id where " . $where_condition;

		include 'db_2020f.php';

		$result = mysqli_query($conn,$sql);
		echo "<table border='1'>
			Report by <b>" . $_POST['by'] . " </b> during period <b> " . $_POST['period'] . " </b> 
			<tr>
			<th>#</th>
			<th>Vendor Name</th>
			<th>Quantity in Stock</th>
			<th>Amount to Vendor</th>
			<th>Sold Quantity</th>
			<th>Sub Total Sale</th>
			<th>Profit</th>
			</tr>
			";

		$idx = 1;
		$cap = mysqli_num_rows($result);
		echo $cap;
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			if($idx == $cap)
			{
				echo "<td>Total</td>";
			}
			else
			{
				echo "<td>" . strval($idx) . "</td>";
			}	
			echo "<td>" . $row['Vendor Name'] . "</td>";
			echo "<td>" . $row['Quantity in Stock'] . "</td>";
			echo "<td>" . $row['Amount to Vendor'] . "</td>";
			echo "<td>" . $row['Sold Quantity'] . "</td>";
			echo "<td>" . $row['Sub Total Sale'] . "</td>";
			echo "<td>" . $row['Profit'] . "</td>";
			echo "</tr>";
			$idx += 1;
		}
			echo "</table>";
	}
?>

<form name='input' action='employee_homepage.php' method='post'>
	<input type='submit' value='Employee Homepage'>	
</form>
<form name='input' action='phase2.html' method='post'>
	<input type='submit' value='Phase2 Homepage'>	
</form>
</html>
