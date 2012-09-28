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

		$errorMsg = null;
		if( empty($username) )
		{
			$GLOBALS['appLog']->log('Empty Username', \Lib\appLogger::INFO, __METHOD__);
			$errorMsg = 'Username is a required field';
		}
		else if( empty($password) )
		{
			$GLOBALS['appLog']->log('Empty Password', \Lib\appLogger::INFO, __METHOD__);
			$errorMsg = 'Password is a required field';
		}

		/*
		 * Either username or password was not entered by the user; display error and login form
		 */
		if (isset($errorMsg))
		{
			\Lib\session::set('errorMsg', $errorMsg);
			header("location: http://" . HOST . URI ."/login");
			exit();
		}

		/*
		 *  Authenticate the username and password
		 */
		$uid = \Models\user::authenticate($username, $password);

		/*
		 *  If the $uid (user id) > 0, then a valid user was found
		 * 		Instantiate user object and check if the user's account has been activated.
		 * 		If not active, then display error and login form
		 */
		if ($uid > 0)
		{
			$user = new \Models\user();
			if ($user->checkActive($uid))
			{
				$GLOBALS['appLog']->log(print_r($user, 1), \Lib\appLogger::DEBUG, __METHOD__);
				\Lib\session::set('username', $username);
				header("location:  http://" . HOST . URI ."/dashboard");
				exit();
			}
			else
			{
				$errorMsg = 'Account has not yet been activated';
				\Lib\session::set('errorMsg', $errorMsg);
				header("location: http://" . HOST . URI ."/login");
				exit();
			}
		}
		else
		{
			$errorMsg = 'Invalid Username/Password';
			\Lib\session::set('errorMsg', $errorMsg);
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
