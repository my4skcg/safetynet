<?php
require_once "PHPUnit/Autoload.php";
//require_once "appLogger.php";

class appLoggerTest extends PHPUnit_Framework_TestCase
{
	public function testAppLogger () {
		$log = new appLogger("/Users/Shared/appLog", 7);
	}
}
