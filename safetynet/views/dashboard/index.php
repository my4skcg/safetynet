<html>

	User is now logged in!</br>
	Hello, 
	
	<?php if (!\Lib\session::get('username'))
	{
		echo "user";
	}
	else 
	{
		echo \Lib\session::get('username');
	} ?>
	!</br>

