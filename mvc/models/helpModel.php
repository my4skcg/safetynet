<?php
//namespace mymvc;

class helpModel extends model {

	function __construct() {
		$GLOBALS['appLog']->log('ENTER HelpModel->__construct', appLogger::INFO);
	}

	function blah() {
		return true;
	}

}

?>
