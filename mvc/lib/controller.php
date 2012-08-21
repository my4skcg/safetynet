<?php
//namespace mymvc;

class controller {
	
	protected $view;
	protected $model;

	function __construct() {

    $GLOBALS['appLog']->log('+++ ENTER controller->__construct', appLogger::INFO);
		$this->view = new view();
	}

	public function loadModel($name) {

		$GLOBALS['appLog']->log('+++ ENTER controller->loadModel; $name= ' . $name, appLogger::INFO);
		
		$fullname = SITEPATH . 'models/' . $name . 'Model.php';
		$GLOBALS['appLog']->log('load: ' . $fullname, appLogger::DEBUG);
		if (file_exists($fullname))
		{
			require $fullname;
			$modelName = $name . 'Model';
			$this->model = new $modelName();
		}
		else
		{
			//echo 'loadModel:: error: file does not exist ' . $fullname . '<br/>';
			$GLOBALS['appLog']->log('loadModel:: error: file does not exist' . $fullname, appLogger::ERR);
		}
		
	}
	
}

?>
