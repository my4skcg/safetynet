<?php
//namespace mymvc;

class view {

	function __construct() {
    $GLOBALS['appLog']->log('+++ ENTER view->__construct', appLogger::INFO);
	}

	public function render ($name, $noInclude = false) {
		$GLOBALS['appLog']->log('+++ ENTER view->render', appLogger::INFO);
		
		$view = 'views/' . $name . '.php';
		$GLOBALS['appLog']->log('VIEW ' . $view, appLogger::INFO);
		
		if ($noInclude) 
			require $view;
		else
		{
			require 'views/header.php';
			require $view;
			require 'views/footer.php';
		}
	}
}
?>
