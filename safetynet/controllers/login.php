<?php
namespace Controllers;

class login extends \Lib\controller {
	
  function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		parent::__construct();
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
  }

	function index() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		//$GLOBALS['appLog']->log('basename of __FILE__ = ' . basename(__FILE__, ".php"), \Lib\appLogger::INFO, __METHOD__);
		$this->view->render(basename(__FILE__, ".php"));
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}

	public function loginAction() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);

		require (SITEPATH . 'config/errorMsgs.php');
		$GLOBALS['appLog']->log('errorMsg[usernameReq]: ' . $errorMsg['usernameReq'] . '   errorMsg[pwdReq]: ' . $errorMsg['pwdReq'], \Lib\appLogger::INFO, __METHOD__);
		
		// @todo : sanitize input vars; don't think I need to since I'm using PDO
		/********
		 *   http://phpmaster.com/input-validation-using-filter-functions/
		 */
		/*
		 * Check if both username and password fields were entered by the user
		 */
		$username = $_POST['username'];
		$password = $_POST['password'];
		$GLOBALS['appLog']->log('Username: ' . $username . '   Password: ' . $password, \Lib\appLogger::INFO, __METHOD__);

		$errorId = null;
		if( empty($username) )
		{
			$GLOBALS['appLog']->log('Empty Username', \Lib\appLogger::INFO, __METHOD__);
			$errorId = 'usernameReq';
		}
		else if( empty($password) )
		{
			$GLOBALS['appLog']->log('Empty Password', \Lib\appLogger::INFO, __METHOD__);
			$errorId = 'pwdReq';
		}


		/*
		 * Either username or password was not entered by the user; display error and login form
		 */
		if (isset($errorId))
		{
			$GLOBALS['appLog']->log('errorId = ' . $errorId, \Lib\appLogger::INFO, __METHOD__);
			$GLOBALS['appLog']->log("errorMsg[" . $errorId . "] = " . $errorMsg[$errorId], \Lib\appLogger::INFO, __METHOD__);
			\Lib\session::set('errorMsg', $errorMsg[$errorId]);
			header("location: http://" . HOST . URI ."/login");
			exit();
		}

		/*
		 *  Authenticate the username and password
		 */
		$uid = \Lib\auth::authenticate($username, $password);

		/*
		 *  If the $uid (user id) > 0, then a valid user was found
		 * 		Instantiate user object and check if the user's account has been activated.
		 * 		If not active, then display error and login form
		 */
		if ($uid > 0)
		{
			$user = new \Models\user($uid);
			if ($user->checkActive())
			{
				$GLOBALS['appLog']->log(print_r($user, 1), \Lib\appLogger::DEBUG, __METHOD__);
				\Lib\session::set('username', $username);
				\Lib\session::set('uid', $uid);
				header("location:  http://" . HOST . URI ."/dashboard");
				exit();
			}
			else
			{
				$errorId = 'acctNotAct';
				\Lib\session::set('errorMsg', $errorMsg[$errorId]);
				header("location: http://" . HOST . URI ."/login");
				exit();
			}
		}
		else
		{
			$errorId = 'invaliduserpwd';
			\Lib\session::set('errorMsg', $errorMsg[$errorId]);
			header("location: http://" . HOST . URI ."/login");
			exit();
		}
		
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}

	public function logoutAction() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		\Lib\session::destroy();
		
		$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/login', \Lib\appLogger::DEBUG, __METHOD__);
		header("location: http://" . HOST . URI ."/login");
		exit();

	}
}
?>
