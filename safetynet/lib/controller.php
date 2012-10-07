<?php
namespace Lib;

class controller {
	
	protected $view;

	function __construct() {

		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		$this->view = new view();
	}
	
}

?>
