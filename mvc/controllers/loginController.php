<?php
//namespace mymvc;

class loginController extends controller {
	
  function __construct() {
		parent::__construct();
		$GLOBALS['appLog']->log('+++ ENTER login Controller->__construct', appLogger::INFO);
  }

	function index() {
		$GLOBALS['appLog']->log('+++ ENTER login Controller->index', appLogger::INFO);
		$this->view->render('login/index');
	}

	public function performLogin() {
		$GLOBALS['appLog']->log('+++ ENTER login Controller->performLogin', appLogger::INFO);
		//require_once (SITEPATH . 'models/loginModel.php');
		$model = new loginModel();
		$model->performLogin();
		//$this->model->performLogin();
	}

}
?>
