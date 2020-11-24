<html>
<?php
	include 'db_2020f.php';

	include 'emp_cookie_check.php';

	$emp_login = $_COOKIE[$cookie_name];
	$res = mysqli_query($conn,"SELECT * FROM CPS5740.EMPLOYEE2");
	$emp_id = -1;
	
	while($row = mysqli_fetch_array($res))
	{
		if(strcasecmp($row['login'],$emp_login) == 0)
		{
			$emp_id = $row['employee_id'];
			break;
		}
	}
	
	$idx = 0;
	while(isset($_POST['Product_ID' . strval($idx)]))
	{
		
		$stridx = strval($idx);
		$fields = array('Product_Name'.$stridx,'Description'.$stridx,'Cost'.$stridx,'Sell_Price'.$stridx,'Available_Quantity'.$stridx,'Vendor_Name'.$stridx);
		$colnames = array('name','description','cost','sell_price','quantity','vendor_id');
		
		$pid = $_POST['Product_ID'.$stridx];
		$arr = mysqli_fetch_array(mysqli_query($conn,"SELECT name,description,cost,sell_price,quantity,vendor_id FROM PRODUCT where id = " . $pid));
		
		$index = 0;
		$sql = "update PRODUCT set ";
		while($index < 6)
		{
			$field = $fields[$index];
			$colname = $colnames[$index];
			if(isset($_POST[$field]) or !empty($_POST[$field]))
			{
				if($index < 5)
				{
					$sql .= $colname . "= '" . $_POST[$field] . "',";
				}
				else
				{
					$sql .= $colname . "= '" . $_POST[$field] . "'";
				}
			}
			$index++;
		}
		$sql .= " where id = $pid";
		$result = mysqli_query($conn, $sql);

		$arr_prime = mysqli_fetch_array(mysqli_query($conn,"SELECT name,description,cost,sell_price,quantity,vendor_id FROM PRODUCT where id = " . $pid));

		$arr_equal = True;
		$idy = 0; 		
		while($idy < 6)
		{
			if($arr[$colnames[$idy]] != $arr_prime[$colnames[$idy]])
			{
				$arr_equal = False;
			}
			$idy += 1;
		}
		if(!$arr_equal)
		{
			$sql = "update PRODUCT set employee_id = " . $emp_id . " where id = $pid";
			$result = mysqli_query($conn,$sql);
		}
		$idx += 1;
	}
	echo "Updated sucessfully!<br>"
?>
<form name='input' action='employee_homepage.php' method='post'>
	<input type='submit' value='Employee Homepage'>	
</form>
<form name='input' action='phase2.html' method='post'>
	<input type='submit' value='Phase2 Homepage'>	
</form>
</html>
