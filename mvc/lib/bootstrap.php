<?php
namespace Lib;

class bootstrap {


  function __construct() {

		/* 
		 * @todo incorporate router and request classes from mvcThephpechoTutorial
		 * should I use 
		 * 		call_user_func(array($controller, $method), $args);
		 * 		slower than below, but can handle methods with different # of args
		 * OR 
		 * 		$controller->{$method}($arg);
		 * 		can $arg be an array of args or can it only be one arg?
		 * 		this is faster than the above
		 */

		//echo '<pre>'.print_r('In Boostrap constructor',1).'</pre>';
    //require (SITEPATH . 'lib/KLogger.php');
		//require_once (SITEPATH . 'app/appLogger.php');
		
		$GLOBALS['appLog']->log('##############  ' . __METHOD__, appLogger::INFO, __METHOD__);
		
		if (DEVELOPMENT_ENVIRONMENT == true) 
		{
			error_reporting(E_ALL);
			ini_set('display_errors','On');
		}

		// Setup the autoloader
		$this->loader();

		// Initialize the session
		session::init();
		
		// Setup the database handling
		require_once (SITEPATH . 'config/database.php');
		require_once (SITEPATH . 'lib/dbHandler.php');
		// @todo do not leave this as a global; implement the registry???
		new dbHandler();

		$this->route(new request());
				

	} // function
	
	private function route(request $request)
	{
			$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
			$GLOBALS['appLog']->log('$request = ' . print_r($request,1), appLogger::DEBUG, __METHOD__);
			
			$cntrlr = $request->getController();
			$method = $request->getMethod();
			$args = $request->getArgs();
			$GLOBALS['appLog']->log('controller = ' . $cntrlr, appLogger::DEBUG, __METHOD__);
			$GLOBALS['appLog']->log('method = ' . $method, appLogger::DEBUG, __METHOD__);
			$GLOBALS['appLog']->log('args = ' . print_r($args,1), appLogger::DEBUG, __METHOD__);

			$controllerFile = SITEPATH.'controllers/'.$cntrlr.'.php';
			$GLOBALS['appLog']->log('controllerFile = ' . $controllerFile, appLogger::DEBUG, __METHOD__);

			if (is_readable($controllerFile))
			{
				// @todo will I split controllers into framework controllers and app controllers?
				$className = sprintf('\Controllers\%s', $cntrlr);
				$GLOBALS['appLog']->log('className = ' . $className, appLogger::DEBUG, __METHOD__);

				$GLOBALS['appLog']->log($controllerFile . ' is readable', appLogger::INFO, __METHOD__);

				$controller = new $className;
				$GLOBALS['appLog']->log('$controller = ' . print_r($controller, 1), appLogger::INFO, __METHOD__);
				
				if (is_callable(array($controller,$method)))
					$GLOBALS['appLog']->log('Callable', appLogger::DEBUG, __METHOD__);
				else
					$GLOBALS['appLog']->log('Not Callable', appLogger::DEBUG, __METHOD__);
				 		

				$method = (is_callable(array($controller,$method))) ? $method : 'index';
				$GLOBALS['appLog']->log('method = ' . $method, appLogger::DEBUG, __METHOD__);

				if (!empty($args))
				{
					call_user_func(array($controller,$method),$args);
				}
				else
				{
					call_user_func(array($controller,$method));
				}
			}
			else
			{
				// handle error somehow
			}
		$GLOBALS['appLog']->log('---   ' . __METHOD__, appLogger::INFO, __METHOD__);
	}
	
	function loader() {
		
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		
		set_include_path(sprintf(
			'%s%s%s',
			get_include_path(),
			PATH_SEPARATOR,
			dirname(dirname(__FILE__))
		));
		
		$GLOBALS['appLog']->log('get_include_path() = ' . get_include_path(), appLogger::INFO, __METHOD__);
		//	spl_autoload_register();

		spl_autoload_register(function($c){
			try { spl_autoload($c); }
			catch(Exception $e) { }
		});

		// framework version. do not touch.
		// @todo check this in all files; die if not set.
		define('FW_VERSION','1.0');

		// set this to the name of your application's namespace.
		// @todo use this in my code???
		define('FW_APP_NS','App');
		
		$GLOBALS['appLog']->log('---   ' . __METHOD__, appLogger::INFO, __METHOD__);

// ********* use an autoloader
//    require_once (SITEPATH . 'lib/view.php');
//    require_once (SITEPATH . 'lib/controller.php');
//    require_once (SITEPATH . 'lib/model.php');
//    require_once (SITEPATH . 'lib/database.php');
//    require_once (SITEPATH . 'lib/session.php');
//		require_once (SITEPATH . 'lib/request.php');
//    require_once (SITEPATH . 'config/database.inc');
//		$GLOBALS['appLog']->log(print_r(get_included_files(),1), appLogger::DEBUG);
		}

	function error($errorMsg) {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		
		//require SITEPATH . 'controllers/errorController.php';
		$controller = new Error($errorMsg);
		$controller->index();

		$GLOBALS['appLog']->log('---   ' . __METHOD__, appLogger::INFO, __METHOD__);
		// @todo Do I really want to return false???
		return false;
	}
	
} // class
?>
