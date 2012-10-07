<?php
namespace Lib;

/**
 * Description of DBConn
 *
 * @author Marion McCaffrey
 */
class dbHandler {
	
	private static $_dbList = array();
	
	public static function getDB($dsn, $username, $password) {
    $GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		if (!isset(self::$_dbList[$dsn][$username]))
		{
      self::$_dbList[$dsn][$username] = new database($dsn, $username, $password);
    }
		
    return self::$_dbList[$dsn][$username];
  }
	
	public function __construct() {	}
}

?>
