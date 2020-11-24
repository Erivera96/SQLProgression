<html>
	<?php
		$cookie_name = "cus_loginId";
		if(!isset($_COOKIE[$cookie_name])) 
		{	 
			echo "Cookie " . $cookie_name . " does not exist!"; 
			exit();
		}
		else 
		{
			setcookie($cookie_name, "", time() - 3600, "/");
		}
	?>	
	
	<meta http-equiv="refresh" content="0; URL=http://eve.kean.edu/~emrivera/CPS5740/phase2/phase2.html" />

</html>
