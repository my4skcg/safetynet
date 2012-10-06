<?php
if (\Lib\session::get('errorMsg'))
{
	$errors = \Lib\session::get('errorMsg');
	foreach ($errors as $err)
		echo $err . "</br>";
	\Lib\session::delete('errorMsg');
}
?>

<h1>Registration</h1>

<form action="profile/register" method="post">
	<label>UserName</label><input type="text" name="username" /><br />
	<label>Password</label><input type="text" name="password" /><br />
	<label>Password Confirm</label><input type="text" name="password2" /><br />
	<label>Email</label><input type="text" name="email" /><br />
	<label></label><input type="submit"/>
</form>
