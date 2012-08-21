<?php
//namespace logger;

require_once (SITEPATH . 'lib/KLogger.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of appLogger
 *
 * @author marnscott
 */
class appLogger extends \KLogger {
	
	private  $_logger;
	private  $_logDirectory;
	private  $_severity;
	
	public function __construct($logDirectory, $severity) {
		
		//echo '<pre>'.'In appLogger constructor'.'</pre>';
		
		$this->_logDirectory = $logDirectory;
		$this->_severity = $severity;
		$this->_logger = parent::instance($logDirectory, $severity);
		
		/*
		echo '<pre>'.'$logDirectory = '.print_r($this->_logDirectory,1).'</pre>';
		echo '<pre>'.'$severity = '.print_r($this->_severity,1).'</pre>';
		echo '<pre>'.'$logger = '.print_r($this->_logger,1).'</pre>';
		 *
		 */
	}
	
	public function log ($line, $severity, $args = self::NO_ARGUMENTS) {
		/*
		echo '<pre>'.'In appLogger logMsg'.'</pre>';
		echo '<pre>'.'$logDirectory = '.print_r($this->_logDirectory,1).'</pre>';
		echo '<pre>'.'$severity = '.print_r($this->_severity,1).'</pre>';
		echo '<pre>'.'$logger = '.print_r($this->_logger,1).'</pre>';
		 * 
		 */
		$this->_logger->log($line, $severity, $args);
	}
}

?>
