<?php
namespace Controllers;

class error extends \Lib\controller {

  function __construct($errorMsg = false) {
    $GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		
		parent::__construct();
		
		if ($errorMsg)
			$this->view->msg = $errorMsg;
		else
			$this->view->msg = 'No Error Message to display';

		$this->view->render(basename(__FILE__, ".php"));
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
  }
	
	function index() {
		
	}

}
?>
