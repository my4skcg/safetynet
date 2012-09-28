<?php
if (\Lib\session::get('errorMsg'))
{
	echo \Lib\session::get('errorMsg');
	\Lib\session::delete('errorMsg');
}
?>

<h1>Login</h1>

<form action="login/loginAction" method="post">
	<label>UserName</label><input type="text" name="username" /><br />
	<label>Password</label><input type="text" name="password" /><br />
	<label></label><input type="submit"/>
</form>