<html>
<?php
	include 'emp_cookie_check.php';

	$emp_id = $_COOKIE[$cookie_name];

	include 'db_2020f.php';

        $search_product = "product";
        $valid = True;

        if(!isset($_POST[$search_product]) or empty($_POST[$search_product]))
        {
                $valid = False;
                echo "Error: Didn't supply ".$search_product.".<br>";
                exit();
        }

	$match = $_POST[$search_product];
	if(strcasecmp($match,'*') == 0)
	{
		$match = '';
	}
        $sql = "select p.id as 'Product ID', p.name as 'Product Name',p.description as 'Description', p.cost as 'Cost', 
                p.sell_price as 'Sell Price', 
                p.quantity as 'Available Quantity', v.name as 'Vendor Name', v.vendor_id as 'Vendor ID',
                e.name as 'Last Update By'
                from PRODUCT as p join CPS5740.VENDOR as v on v.vendor_id = p.vendor_id
                join CPS5740.EMPLOYEE2 as e on e.employee_id = p.employee_id 
                where p.name like '%" . $match . "%' order by p.id";
	$result = mysqli_query($conn, $sql);
	echo "<caption><b> Update Product Information </b></caption>";
	echo "<form name='input' action='employee_update_product.php' method='post' >";
	echo "<table border='1'>
		<tr>
		<th>Product ID</th>
		<th>Product Name</th>
		<th>Description</th>
		<th>Cost</th>
		<th>Sell Price</th>
		<th>Available Quantity</th>
		<th>Vendor Name</th>
		<th>Last Update By</th>
		</tr>
		";

	$idx = 0;
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['Product ID'] . "</td>";
		echo "<td> <input type='text' name='Product Name$idx' value='" . $row['Product Name'] . "'></td>";
		echo "<td> <input type='text' name='Description$idx' value='" . $row['Description'] . "'></td>";
		echo "<td> <input type='text' name='Cost$idx' value='" . $row['Cost'] . "'></td>";
		echo "<td> <input type='text' name='Sell Price$idx' value='" . $row['Sell Price'] . "'></td>";
		echo "<td> <input type='text' name='Available Quantity$idx' value='" . $row['Available Quantity'] . "'></td>";
		echo "<td>";
		echo "<select name='Vendor Name$idx' id='Vendor Name$idx'>";
		echo "<option value='".$row['Vendor ID']."'>".$row['Vendor Name']."</option>";
		
		$result2 = mysqli_query($conn,"SELECT * FROM CPS5740.VENDOR");
		while($row2 = $result2 -> fetch_assoc())
		{
			$name = $row2['name']; 
			$id = $row2['vendor_id'];
			echo '<option value="'.$id.'">'.$name.'</option>';
		}
		
		echo "</select> </td>";
		echo "<td>" . $row['Last Update By'] . "</td>";
		echo "<input type='hidden' name='Product ID$idx' value='" . $row['Product ID'] . "'>";
		echo "</tr>";
		$idx += 1;
	}
	
	echo "</table>";
	echo "<input type='submit' value='Update Information'/>";
	echo "</form>";
?>
</html>
