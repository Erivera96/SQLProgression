<html>
	<?php
		
		include "db_2020f.php";
		
		$fields = array('password','first_name','last_name','TEL','address','city','zipcode','state');
			
		$index = 0;
		
		$sql = "update CUSTOMER set ";
		
		while($index < 8)
		{
			$field = $fields[$index];
			
			if(isset($_POST[$field]) or !empty($_POST[$field]))
			{	
				if($index < 7)
				{
					$sql .= $field . "= '" . $_POST[$field] . "',";
				}
				else
				{
					$sql .= $field . "= '" . $_POST[$field] . "'";
				}
			}
			$index++;
		}
		$sql .= " where login_id = '$_COOKIE[cus_loginId]'";
		$result = mysqli_query($conn, $sql);
		
		echo "Information successfully updated!";
		echo "<form name='input' action='phase2.html' method='post'>
			<input type='submit' value='Phase2 Homepage'>	
	              </form>";
	?>
</html>
