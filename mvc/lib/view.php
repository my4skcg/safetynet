<?php
namespace Lib;

class view {

	function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
	}

	public function render ($name, $noInclude = false) {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		
		$view = 'views/' . $name . '.php';
		$GLOBALS['appLog']->log('VIEW ' . $view, appLogger::INFO, __METHOD__);
		
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
