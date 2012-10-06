<?php
namespace Models;

/**
 * Description of user
 *
 * @author marnscott
 */
class user {

	private $id;
	private $username;
	private $email;
	private $active;
	private $activateKey;

	public static function userExists($username)
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

		$selectClause = '`id`';
		$whereClause = '`username`=:username';
		$whereData = array(
				'username' => $username
		);
		
		$results = $db->select(USERS_TABLE, $selectClause, $whereClause, $whereData);
		$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);

		if ($results['count'] == 0)
			return false;
		else
			return true;

	}

	public function  __construct($id, $user = array())
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);

		if ($id == 0)
		{
			// create a new user in the db
			$this->username = $user['username'];
			$this->email = $user['email'];
			$this->activateKey = $user['activateKey'] = $this->createActivateKey();
			$this->createNewUser($user);
			return $this;
		}
 		else
		{
			// get the data for this user id from the db
			$this->getUserData($id);
			$this->id = $id;
			return $this;
		}
	}
	
	/**
	 * check if the user has activated the account
	 */
	public function checkActive()
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, \Lib\appLogger::INFO, __METHOD__);
		return ($this->active ? true : false);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getActivateKey()
	{
		return $this->activateKey;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function activate($key)
	{
		$GLOBALS['appLog']->log('key: ' . $key, \Lib\appLogger::INFO, __METHOD__);
		$GLOBALS['appLog']->log('this->activateKey: ' . $this->activateKey, \Lib\appLogger::INFO, __METHOD__);
		if ($key == $this->activateKey)
		{
			$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
			$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

			$data = array(
					'active' => true,
					'activateKey' => ''
			);

			$whereClause = '`id`=:id';
			$whereData = array(
					'id' => $this->id
			);

			try
			{
				$results = $db->update(USERS_TABLE, $data, $whereClause, $whereData);
				$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);


			} catch(PDOException $e) {
				die('PDO Exception: ' . $e->getMessage());
			}
		}
		else
		{
			// the activate key in db does not match the activate key in link
			die ("activate keys do not match");
		}
	} // end function activate

	/**
	 * gets user data from database
	 */
	private function getUserData($id)
	{
		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

		//$selectClause = '`active`, `activateKey`, `username`, `email`';
		$selectClause = '*';
		$whereClause = '`id`=:id';
		$whereData = array(
				'id' => $id
		);
		
		try
		{

  		$results = $db->select(USERS_TABLE, $selectClause, $whereClause, $whereData);
  		$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);
  
  		// @todo use Object Mapping instead???
  		if ($results['count'] === 1)
  		{
  			$this->active = $results['data'][0]['active'];
  			$this->activateKey = $results['data'][0]['activateKey'];
  			$this->id = $results['data'][0]['id'];
  			$this->username = $results['data'][0]['username'];
  			$this->email = $results['data'][0]['email'];
  		}
  		else
  		{
  			// exception
  		}
		} catch(PDOException $e) {
		  die('PDO Exception: ' . $e->getMessage());
		}

	}

	/**
	 * creates user in database
	 */
	private function createNewUser($user)
	{
		$this->active = false;

		$dsn = (\Config\DB_TYPE.':host='. \Config\DB_HOST.';dbname='. \Config\DB_NAME);
		$db = \Lib\dbHandler::getDB($dsn, \Config\DB_USER, \Config\DB_PWD);

		try
		{
  		$results = $db->insert(USERS_TABLE, $user);
  		$GLOBALS['appLog']->log(print_r($results, 1), \Lib\appLogger::DEBUG, __METHOD__);
  
			// returns the user id, if error the user id will be 0
  		if ($results['count'] === 1)
  		{
  			$this->id = $db->lastInsertId();
  		}
			else
			{
  			// some kind of error 
  			// @todo handle this error
  			die ("Database Insert Error");
			}
		} catch(PDOException $e) {
		  die('PDO Exception: ' . $e->getMessage());
		}
	}

	private function createActivateKey()
	{
		return (md5(uniqid(rand(), true)));
	}

}
?>
