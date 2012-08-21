<?php
//namespace mymvc;

class loginModel extends model {

	function __construct() {
		parent::__construct();
    $GLOBALS['appLog']->log('+++ ENTER loginModel->__construct', appLogger::INFO);
	}

	function performLogin() {
		
    $GLOBALS['appLog']->log('+++ ENTER loginModel->performLogin', appLogger::INFO);
		// @todo : sanitize input vars
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE username = :username AND password = :password;";

		$GLOBALS['appLog']->log(print_r($sql, 1), appLogger::DEBUG);
		$GLOBALS['appLog']->log(':username = ' . print_r($username, 1) . ';  :password = ' . print_r($password, 1), appLogger::DEBUG);

		$stmt = $this->db->prepare($sql);
			
		$stmt->execute(array(
				':username' => $username,
				':password' => $password
		));

		$data = $stmt->fetchAll();
		$count = $stmt->rowCount();
		$GLOBALS['appLog']->log('rowCount = ' . $count, appLogger::DEBUG);
		$GLOBALS['appLog']->log(print_r($data, 1), appLogger::DEBUG);

		//$GLOBALS['appLog']->log('$_SERVER[HTTP_HOST] = ' . $host, appLogger::DEBUG);
		//$GLOBALS['appLog']->log('$_SERVER[PHP_SELF] = ' . $_SERVER['PHP_SELF'], appLogger::DEBUG);
		//$GLOBALS['appLog']->log('$uri = ' . $uri, appLogger::DEBUG);
		
		
		if ($count > 0)
		{
			session::set('username', $username);

			$GLOBALS['appLog']->log('session key username = ' . session::get('username'), appLogger::DEBUG);
			$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/dashboard', appLogger::DEBUG);
			header("location:  http://" . HOST . URI ."/dashboard");
			exit();
		}
		else
		{
			session::destroy();
			
			// @todo show an error
			$GLOBALS['appLog']->log('Error : user not found in database', appLogger::DEBUG);
			$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/login', appLogger::DEBUG);
			header("location: http://" . HOST . URI ."/login");
			exit();

		}
	}

}

?>
