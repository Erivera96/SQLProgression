<html>
	<?php

		include 'db_2020f.php';		

		$fields = array('username','password','retyped_password','first_name','last_name','tel','address','city','zipcode','state');
		$inputs = array('username','password','retyped_password','first name','last name', 'telephone number','address','city','zipcode','state');
		
		$index = 0;
		$valid = True;

		while ($index < 10) 
		{
        		$field = $fields[$index];
        		$input = $inputs[$index];
        		
			if(!isset($_POST[$field]) or empty($_POST[$field]))
        		{
                		$valid = False;
                		echo "Error: Didn't supply ".$input.".<br>";
        		}
        		$index++;
		}

		if(!$valid) 
		{
			exit();
		}
		
		
		$matching_password = True;
		if(strcmp($_POST['password'], $_POST['retyped_password']) != 0)
		{
			$matching_password = False;
		}

		if(!$matching_password)
		{
			echo "Passwords do not match, try again. <br>";
			exit();
		}
		
		$sql = "select login_id from CUSTOMER";
		$result = mysqli_query($conn, $sql);

		while($row = mysqli_fetch_array($result))
		{
			if(strcasecmp($row['login_id'], $_POST['username']) == 0)
			{
				echo "User name already in use, try again.<br>";
				exit();
			}
		}

		$sql = "insert into CUSTOMER (login_id, password, first_name, last_name, TEL, address, city, zipcode, state) values ('$_POST[username]','$_POST[password]','$_POST[first_name]','$_POST[last_name]','$_POST[tel]','$_POST[address]','$_POST[city]','$_POST[zipcode]','$_POST[state]')";

		if($conn->query($sql) === TRUE) 
		{
		  echo "New record created successfully!";
		  echo "<form name='input' action='phase2.html' method='post'>
			   <input type='submit' value='Phase2 Homepage'>	
		        </form>";
		} 
		else 
		{
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
	?>
</html>
