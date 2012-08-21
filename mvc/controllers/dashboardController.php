<?php
//namespace mymvc;

class dashboardController extends controller {
	
	function __construct() {
		parent::__construct();
    $GLOBALS['appLog']->log('ENTER dashboard Controller->__construct', appLogger::INFO);					
		$GLOBALS['appLog']->log('session key username = ' . session::get('username'), appLogger::DEBUG);
		
		if (session::get('username') == false)
		{
			session::destroy();
			
			$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/login', appLogger::DEBUG);
			header("location: http://" . HOST . URI ."/login");
			exit();
		}
		
  }

	function index() {
		$GLOBALS['appLog']->log('ENTER dashboard Controller->index', appLogger::INFO);
		$GLOBALS['appLog']->log('session key username = ' . session::get('username'), appLogger::DEBUG);
		
		$this->view->render('dashboard/index');
	}
	
	function logout() {
		$GLOBALS['appLog']->log('ENTER dashboard Controller->logout', appLogger::INFO);
		session::destroy();
		
		$GLOBALS['appLog']->log('calling header with http://' . HOST . URI . '/login', appLogger::DEBUG);
		header("location: http://" . HOST . URI ."/login");
		exit();
	}

}
?>
