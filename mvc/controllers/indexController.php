<?php
//namespace mymvc;

class indexController extends controller {

  function __construct() {
    $GLOBALS['appLog']->log('+++ ENTER Index Controller->__construct', appLogger::INFO);
		parent::__construct();
  }

	function index() {
    $GLOBALS['appLog']->log('+++ ENTER Index Controller->index', appLogger::INFO);
		$this->view->render('index/index');
	}

	function details() {
		$GLOBALS['appLog']->log('+++ ENTER Index Controller->details', appLogger::INFO);
		$this->view->render('index/index');
	}

}
?>
