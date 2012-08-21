<?php
//namespace mymvc;

class helpController extends controller {

  function __construct() {
		parent::__construct();
		$GLOBALS['appLog']->log('ENTER Help Controller->__construct', appLogger::INFO);
		//$this->view->render('help/index');
  }

	function index() {
		$GLOBALS['appLog']->log('ENTER Help Controller->index', appLogger::INFO);
		$this->view->render('help/index');
	}
  
  public function other($arg = false) {
    $GLOBALS['appLog']->log('ENTER Help Controller->other', appLogger::INFO);
    $GLOBALS['appLog']->log('Optional :' . $arg, appLogger::DEBUG);
		
		//require 'models/helpModel.php';
		$help = new helpModel();
		$this->view->blah = $model->blah();
  }

}
?>
