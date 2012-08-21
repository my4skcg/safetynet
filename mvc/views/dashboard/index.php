<html>

	User is now logged in!</br>
	Hello, 
	
	<?php if (!session::get('username'))
	{
		echo "user";
	}
	else 
	{
		echo session::get('username');
	} ?>
	!</br>

