<html>
<?php
	include 'emp_cookie_check.php';
?>

<form name="input" action="employee_logout.php" method="post">
	<input type="submit" value="Employee Logout">
</form>

<form name="input" action="employee_homepage.php" method="post">
	<input type="submit" value="Employee Home">
</form>

<br>
<form name='input' action='employee_display_product.php' method='post'>
	<caption>search product (* for all)</caption>
	<br>
	<input type='text' name='product'>
	<input type='submit' value='Search'>
</form>
<br>
</html>
