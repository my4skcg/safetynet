<?php
namespace Models;

class help extends \Lib\model {

	function __construct() {
				$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}

	function blah() {
		return true;
	}

}

?>
