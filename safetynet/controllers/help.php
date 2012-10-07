<?php
namespace Controllers;

class help extends \Lib\controller {

  function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		parent::__construct();
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
  }

	function index() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		$this->view->render('help/index');
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}
  
  public function other($arg = false) {
    $GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
    $GLOBALS['appLog']->log('Optional :' . $arg, \Lib\appLogger::DEBUG, __METHOD__);
		
		//require 'models/helpModel.php';
		$help = new helpModel();
		$this->view->blah = $model->blah();
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
  }

}
?>
