<?php
namespace Controllers;

class dashboard extends \Lib\controller {
	
	function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		parent::__construct();					
		$GLOBALS['appLog']->log('session key username = ' . \Lib\session::get('username'), \Lib\appLogger::DEBUG, __METHOD__);
		
		if (\Lib\session::get('username') == false)
		{
			\Lib\session::destroy();
			
			$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/login', \Lib\appLogger::DEBUG, __METHOD__);
			header("location: http://" . HOST . URI ."/login");
			exit();
		}
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
  }

	function index() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		$GLOBALS['appLog']->log('session key username = ' . \Lib\session::get('username'), \Lib\appLogger::DEBUG, __METHOD__);
		
		$this->view->render('dashboard/index');
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}
	
}
?>
