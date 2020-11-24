<html>
	<?php
		include 'db_2020f.php';
		
		$cus_usrnm =$_POST["username"];
		$cus_pwd =trim($_POST["password"]);
		
		if(empty($cus_usrnm) && empty($cus_pwd))
		{
			echo "You are missing: username and password"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else if(empty($cus_usrnm))
		{
			echo "You are missing: username"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else if(empty($cus_pwd))
		{
			echo "You are missing: password"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else
		{
			$sql = "select login_id, password from CUSTOMER";
			$result = mysqli_query($conn, $sql);
			$usr_valid = False;
			$pwd_valid = False;
			
			while($row = mysqli_fetch_array($result))
			{
				if(strcasecmp($row['login_id'], $cus_usrnm) == 0)
				{
					$usr_valid = True; 
					if(strcmp($row['password'], $cus_pwd) == 0)
					{
						$pwd_valid = True;
					}
				}
			}
					
			if($usr_valid && $pwd_valid)
			{
				$cookie_name = "cus_loginId";
				$cookie_value = $cus_usrnm;
				$cookie = setcookie($cookie_name, $cookie_value, time() + 3600, "/");
				echo "<meta http-equiv='refresh' content='0; URL=http://eve.kean.edu/~emrivera/CPS5740/phase2/customer_check_p2.php' />";
			}	
			else if($usr_valid == False)
			{
				echo "Invalid username. Program will exit.<br>\n";
				exit();
			}
			else if($pwd_valid == False)
			{
				echo "Invalid password. Program will exit.<br>\n";
				exit();
			}
		}
	?>
</html>
