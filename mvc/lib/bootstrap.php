<?php
//namespace mymvc;

class Bootstrap {


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
		
    function myAutoloader($class) {
			 $GLOBALS['appLog']->log('ENTER bootstrap->myAutoloader(): $class= '. $class, appLogger::INFO);

			 $file1 = SITEPATH.'controllers/'.$class.'.php';
			 $file2 = SITEPATH.'lib/'.$class.'.php';
			 $file3 = SITEPATH.'models/'.$class.'.php';

			 if (file_exists($file1)) {
						$GLOBALS['appLog']->log('include file1= '. $file1, appLogger::INFO);
						include $file1;
			 } elseif (file_exists($file2)) {
						$GLOBALS['appLog']->log('include file2= '. $file2, appLogger::INFO);
						include $file2;
			 } elseif (file_exists($file3)) {
						$GLOBALS['appLog']->log('include file3= '. $file3, appLogger::INFO);
						include $file3;
			 } else {
						die('class '.$class.' not found');
			 }
		}
		
		$GLOBALS['appLog']->log('##############  ENTER Boostrap->__construct', appLogger::INFO);

		set_include_path(get_include_path() . PATH_SEPARATOR . SITEPATH);
		$GLOBALS['appLog']->log('get_include_path() = ' . get_include_path(), appLogger::DEBUG);
		


		spl_autoload_extensions('.php, .inc');
		
//		spl_autoload_register('myAutoloader');

//			spl_autoload_register();
		spl_autoload_register(function($class) {
			include $class . '.php';
		});
		
		// ********* use an autoloader
//    require_once (SITEPATH . 'lib/view.php');
//    require_once (SITEPATH . 'lib/controller.php');
//    require_once (SITEPATH . 'lib/model.php');
//    require_once (SITEPATH . 'lib/database.php');
//    require_once (SITEPATH . 'lib/session.php');
//		require_once (SITEPATH . 'lib/request.php');
//    require_once (SITEPATH . 'config/database.inc');
//		require_once (SITEPATH . 'application/const.php');
//		$GLOBALS['appLog']->log(print_r(get_included_files(),1), appLogger::DEBUG);

		session::init();
		$this->route(new request());
				

	} // function
	
	private function route(request $request)
	{
			$GLOBALS['appLog']->log('ENTER bootstrap->route()', appLogger::INFO);
			$GLOBALS['appLog']->log('$request = ' . print_r($request,1), appLogger::DEBUG);
			
			$cntrlr = $request->getController();
			$method = $request->getMethod();
			$args = $request->getArgs();
			$GLOBALS['appLog']->log('controller = ' . $cntrlr, appLogger::DEBUG);
			$GLOBALS['appLog']->log('method = ' . $method, appLogger::DEBUG);
			$GLOBALS['appLog']->log('args = ' . print_r($args,1), appLogger::DEBUG);

			$controllerFile = SITEPATH.'controllers/'.$cntrlr.'.php';
			$GLOBALS['appLog']->log('controllerFile = ' . $controllerFile, appLogger::DEBUG);

			if (is_readable($controllerFile))
			{
				$GLOBALS['appLog']->log('require the controller file', appLogger::INFO);
				//require_once $controllerFile;

				$GLOBALS['appLog']->log($controllerFile . ' is readable', appLogger::INFO);
				$controller = new $cntrlr;
				$GLOBALS['appLog']->log('$controller = ' . print_r($controller, 1), appLogger::INFO);
				//$controller->loadModel($cntrlr);
				
				if (is_callable(array($controller,$method)))
					$GLOBALS['appLog']->log('Callable', appLogger::DEBUG);
				else
					$GLOBALS['appLog']->log('Not Callable', appLogger::DEBUG);
				 		

				$method = (is_callable(array($controller,$method))) ? $method : 'index';
				$GLOBALS['appLog']->log('method = ' . $method, appLogger::DEBUG);

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
	}

	function error($errorMsg) {
		$GLOBALS['appLog']->log('ENTER bootstrap->error()', appLogger::INFO);
		
		//require SITEPATH . 'controllers/errorController.php';
		$controller = new Error($errorMsg);
		$controller->index();

		// do I really want to return false???
		return false;
	}
	
} // class
?>
