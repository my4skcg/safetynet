<?php
//namespace mymvc;

class model {
	protected $db;
	
	function __construct() {
		$GLOBALS['appLog']->log('+++ ENTER model->__construct', appLogger::INFO);
		$this->db = new database();
	}

}
?>
