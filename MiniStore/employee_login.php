<html>
	<?php
		include 'db_cps5740.php';
		
		$emp_usrnm = $_POST["user"];
		$emp_pwd = trim($_POST["password"]);
		
		if(empty($emp_usrnm) && empty($emp_pwd))
		{
			echo "You are missing: username and password"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else if(empty($emp_usrnm))
		{
			echo "You are missing: username"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else if(empty($emp_pwd))
		{
			echo "You are missing: password"."<br>\n";
			echo "Program will exit.";
			exit();
		}
		else
		{
			$sql = "select login, password from EMPLOYEE2";
		
			$result = mysqli_query($conn, $sql);
			
			$usr_valid = False;
			$pwd_valid = False;
			
			while($row = mysqli_fetch_array($result))
			{
				if(strcasecmp($row['login'], $emp_usrnm) == 0)
				{
					$usr_valid = True; 
					$emp_pwd = hash('sha256', $emp_pwd);

					if(strcmp($row['password'], $emp_pwd) == 0)
					{
						$pwd_valid = True;
					}
				}
			}
			
			if($usr_valid && $pwd_valid)
			{
				
				$cookie_name = "emp_loginId";
				$cookie_value = $emp_usrnm;
				$cookie = setcookie($cookie_name, $cookie_value, time() + 3600, "/");
				echo "<meta http-equiv='refresh' content='0; URL=http://eve.kean.edu/~emrivera/CPS5740/phase2/employee_homepage.php' />";
			}
			else if($usr_valid == False)
			{
				echo "Login id, $emp_usrnm, does not exit in the Database.<br>\n";
				echo "Program will exit.";
				exit();
			}
			else if(($usr_valid == True) && ($pwd_valid == False))
			{
				echo "Login id, $emp_usrnm, does exist.<br>\n";
				echo "Password does not match.<br>\n";
				echo "Program will exit.";
				exit();
			}
		}
	?>
</html>
