<?php
//namespace mymvc;

/**
 * Description of session
 *
 * @author marnscott
 */

class session {
	
	public static function init () {
		if(!session_id()) 
		{
			$GLOBALS['appLog']->log('session_start()', appLogger::DEBUG);
			session_start();
		}
	}
	
	public static function set ($key, $value) {
		
    $GLOBALS['appLog']->log('Setting session[' . $key . '] to ' . $value, appLogger::DEBUG);
		
		$_SESSION[$key] = $value;
	}
	
	public static function get ($key) {

		if (isset($_SESSION[$key]))
			return $_SESSION[$key];
		else
			return false;
	}
	
	public static function delete ($key) {
		session_unregister($key);
	}
	
	public static function destroy () {
		
		session_unset();
		session_destroy();
	}
}

?>
