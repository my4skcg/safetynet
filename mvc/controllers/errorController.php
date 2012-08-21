<?php
//namespace mymvc;

class errorController extends controller {

  function __construct($errorMsg = false) {
		parent::__construct();
    $GLOBALS['appLog']->log('ENTER Error Controller->__construct', appLogger::INFO);
		
		if ($errorMsg)
			$this->view->msg = $errorMsg;
		else
			$this->view->msg = 'No Error Message to display';

		$this->view->render('error/index');
  }

}
?>
