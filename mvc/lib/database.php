<?php
namespace Lib;

class database extends \PDO {
	
	private $connection;
	
	public function __construct($dsn, $username, $password) {
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		$connection = parent::__construct($dsn, $username, $password);	
	}

	/**
	 * update
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array containing data to select
	 * @param string $where An associate array containing the where criteria
	 */
	public function select ($table, $selectClause, $whereClause, $whereData)
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		
		$stmt = $this->prepare("SELECT $selectClause FROM $table WHERE $whereClause");
		
		foreach ($whereData as $key => $value) 
		{
			$stmt->bindValue(":$key", $value);
		}
		
		$GLOBALS['appLog']->log('stmt = ' . print_r($stmt, 1), \Lib\appLogger::DEBUG, __METHOD__);
		
		$stmt->execute();
	//	$stmt->bind_result($result);   ??? do i want to use this?
		
		$data = $stmt->fetchAll();
		$count = $stmt->rowCount();
		$GLOBALS['appLog']->log('rowCount = ' . $count, \Lib\appLogger::DEBUG, __METHOD__);
		$GLOBALS['appLog']->log(print_r($data, 1), \Lib\appLogger::DEBUG, __METHOD__);

		return array('count'=>$count, 'data'=>$data);
	}
	
	/**
	 * insert
	 * @param type $table Name of the table in which to insert data
	 * @param type $data An associative array of the data to insert into $table
	 */
	public function insert ($table, $data)
	{
		$GLOBALS['appLog']->log('+++   ' . __METHOD__, appLogger::INFO, __METHOD__);
		ksort($data);
		
		$GLOBALS['appLog']->log(print_r($data, 1), appLogger::INFO, __METHOD__);
		
		$fieldnames = implode('`,`', array_keys($data));
		$fieldvalues = ':' . implode(', :', array_keys($data));
		$sql = "INSERT INTO $table (`$fieldnames`) VALUES ($fieldvalues)";
		
		$GLOBALS['appLog']->log($sql, appLogger::INFO, __METHOD__);
		
		$stmt = $this->prepare($sql);
		foreach ($data as $key => $value) 
		{
			$stmt->bindValue(":$key", $value);
		}
		
		$stmt->execute();
		
	}
	
	/**
	 * update
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 * @param string $where the WHERE query part
	 */
	/* @todo change params and prepare to include
	 *		whereClause and whereData
	 *		like select function
	 */
	
	public function update ($table, $data, $where)
	{
		ksort($data);
		
		$fieldDetails = NULL;
		foreach($data as $key=> $value) {
			$fieldDetails .= "`$key`=:$key,";
		}
		$fieldDetails = rtrim($fieldDetails, ',');
		
		$stmt = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		
		foreach ($data as $key => $value) {
			$stmt->bindValue(":$key", $value);
		}
		
		$stmt->execute();

	}

}

?>
