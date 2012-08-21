<?php
//namespace mymvc;

class database extends PDO {
	
	protected $connection = null;

	public function __construct() {
		$GLOBALS['appLog']->log('+++ ENTER database->__construct()', appLogger::INFO);
		require_once (SITEPATH . 'config/database.inc');
//		if ( extension_loaded('pdo') )
//			$GLOBALS['appLog']->log('extension PDO IS loaded', appLogger::DEBUG); 
//		else
//			$GLOBALS['appLog']->log('extension PDO IS *NOT* loaded', appLogger::DEBUG); 
//
//		if (class_exists('PDO', false))
//			$GLOBALS['appLog']->log('class PDO exists', appLogger::DEBUG); 
//		else
//			$GLOBALS['appLog']->log('class PDO *NOT* exists', appLogger::DEBUG); 
//				
//		$GLOBALS['appLog']->log('db connection =' . DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME . ',' . DB_USER . ',' . DB_PWD, appLogger::INFO);

		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PWD);
			
	}

}
?>
