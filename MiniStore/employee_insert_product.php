<html>
	<?php

		$fields = array('name','description','cost','sell_price','quantity','vendor');
		
		$index = 0;
		$valid = True;

		while($index < 6) 
		{
        		$field = $fields[$index];
        		
			if(!isset($_POST[$field]) or empty($_POST[$field]))
        		{
                		$valid = False;
                		echo "Error: Didn't supply ".$field.".<br>";
        		}
        		$index++;
		}
		
		if($valid)
		{	
			include 'db_2020f.php';
			$sql = "select * from PRODUCT";
			$result = mysqli_query($conn, $sql);

			while($row = mysqli_fetch_array($result))
			{
				if(strcasecmp($_POST['name'], $row['name']) == 0)
				{
					$valid = False;
					echo $_POST['name'].' already exists in the database!';
				}
			}

			if( (floatval($_POST['cost']) < 0) || (floatval($_POST['sell_price']) < 0) || (intval($_POST['quantity']) < 0) )
			{
				$valid = False;
				echo 'Numerical values must be positive!';
			}

			if(floatval($_POST['cost']) >= floatval($_POST['sell_price']))
			{
				$valid = False;
				echo 'Cost must be less than sell price!';
			}	
		}

		if(!$valid)
		{
			exit();
		}
		
		include 'db_cps5740.php';

		$cookie_name = "emp_loginId";	
		$sql = "select employee_id, login from EMPLOYEE2";

		$result = mysqli_query($conn, $sql);
		$employee_id = 0;

		while($row = mysqli_fetch_assoc($result))
		{
			if(strcasecmp($row['login'], $_COOKIE[$cookie_name]) == 0)
			{
				$employee_id = $row['employee_id'];
			}
		}

		include 'db_2020f.php';

		$sql = "insert into PRODUCT (description, name, vendor_id, cost, sell_price, quantity, employee_id) values ('$_POST[description]','$_POST[name]','$_POST[vendor]','$_POST[cost]','$_POST[sell_price]','$_POST[quantity]','$employee_id')";

		if($conn->query($sql) === TRUE) 
		{
			
		  	echo "<br><form name='input' action='employee_logout.php' method='post'>
				<input type='submit' value='Employee Logout'>
				</form><br>";
			
			echo "Successfully inserted the product: " . $_POST['name'];
			
		  	echo "<br><form name='input' action='employee_homepage.php' method='post'>
				<input type='submit' value='Employee Homepage'>
				</form><br>";
			
			echo "<br><form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Phase2 Homepage'>
				</form>";
		} 
		else 
		{
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	?>
</html>
