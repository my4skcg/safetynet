<?php
namespace Lib;

class model {
	//protected $db;
	
	function __construct() {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		/*
		require_once (SITEPATH . 'config/database.php');
		
		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		//$GLOBALS['appLog']->log(sprintf('dsn: "%s", user: "%s", pwd: "%s"', $dsn, \Config\DB_USER, \Config\DB_PWD ), appLogger::DEBUG, __METHOD__);
		
		$this->db = new database($dsn, \Config\DB_USER, \Config\DB_PWD);
		 * 
		 */
	}

}
?>
