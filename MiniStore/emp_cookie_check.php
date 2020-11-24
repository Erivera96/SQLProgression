<?php

	$cookie_name = "emp_loginId";
	if(!isset($_COOKIE[$cookie_name]))
	{
		echo "
			<form name='input' action='employee_login.html' method='post'>
				<input type='submit' value='Employee Login'>
			</form>
			<form name='input' action='phase2.html' method='post'>
				<input type='submit' value='Home'>
			</form>
			";
		exit();
	}
?>
