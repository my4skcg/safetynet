<?php
//namespace mymvc;

	class request {

		private $_controller;
		private $_method;
		private $_args;

		public function __construct() {
			
			$GLOBALS['appLog']->log('+++ ENTER Request->__construct()', appLogger::INFO);
			
			$url = isset($_GET['url']) ? $_GET['url'] : null;
			$GLOBALS['appLog']->log('$_GET[url] = ' . $url, appLogger::DEBUG);

			$parts = explode('/', $url);
			$parts = array_filter($parts);
			$GLOBALS['appLog']->log('$parts = ' . print_r($parts,1), appLogger::DEBUG);

			$this->_controller = ($c = array_shift($parts))? $c . 'Controller': 'indexController';
			$this->_method = ($c = array_shift($parts))? $c: 'index';
			$this->_args = (isset($parts[0])) ? $parts : array();

			$GLOBALS['appLog']->log('_controller = ' . $this->_controller, appLogger::DEBUG);
			$GLOBALS['appLog']->log('_method = ' . $this->_method, appLogger::DEBUG);
			$GLOBALS['appLog']->log('_args = ' . print_r($this->_args,1), appLogger::DEBUG);
			
			$GLOBALS['appLog']->log('+++ EXIT Request->__construct()', appLogger::INFO);

		}

		public function getController() {
			return $this->_controller;
		}

		public function getMethod() {
			return $this->_method;
		}

		public function getArgs() {
			return $this->_args;
		}
	}
?>
