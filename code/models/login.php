<?php
namespace Models;

/*
 * 		@todo CURRENTLY THIS CLASS IS NOT USED; DELETE
 */

class login extends \Lib\model {

	function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		parent::__construct();
	}

	function performLogin() {		
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
				
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}

}

?>
