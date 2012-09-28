<?php
namespace Models;

/**
 * Description of user
 *
 * @author marnscott
 */
class user {

	private $username;
	private $email;


	/**
	 * 
	 * @param type $username
	 * @param type $pwd password
	 */
	static function authenticate ($username, $pwd)
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		// @todo : sanitize input vars; don't think I need to since I'm using PDO
		/********
		 *   http://phpmaster.com/input-validation-using-filter-functions/
		 */
		$password = static::encrypt($pwd);

		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

		$selectClause = '`id`, `username`';
		$whereClause = '`username`=:username AND`password`=:password';
		$whereData = array(
				'username' => $username,
				'password' => $password
		);
		
		$results = $db->select(USERS_TABLE, $selectClause, $whereClause, $whereData);
		$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);

		if ($results['count'] == 1)
		{
			$GLOBALS['appLog']->log("id = " . $results['data'][0]['id'], \Lib\appLogger::DEBUG, __METHOD__);
			return $results['data'][0]['id'];
		}
		else if ($results['count'] == 0)
			return false;
		else
		{
			// exception; more than one row found
		}
		
		$GLOBALS['appLog']->log('---   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
	}
	
	/**
	 * 
	 * @param type $p
	 */
	static function encrypt($p)
	{
		return md5($p);

	}

	public function  __construct()
	{
	}
	
	/**
	 * gets user data from database
	 */
	public function checkActive($id)
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

		$selectClause = '`active`, `username`, `email`';
		$whereClause = '`id`=:id';
		$whereData = array(
				'id' => $id
		);
		
		$results = $db->select(USERS_TABLE, $selectClause, $whereClause, $whereData);
		$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);

		if ($results['count'] == 1)
		{
			if ($results['data'][0]['active'])
			{
				$this->username = $results['data'][0]['username'];
				$this->email = $results['data'][0]['email'];
				return true;
			}
			else
				return false;
		}
		else
		{
			// exception
		}
		
	}

	/**
	 * creates user in database
	 */
	public function create()
	{
		
	}

}
?>
