<?php

class Database {
	private $_connect = NULL;
	private static $_instance = Null;

	public function __construct() {
		$this->connectDB();
	}

	/**
	 * This function is used to connect to database
	 * 
	 */
	private function connectDB()
	{
		try {
			$this->_connect = new PDO('mysql:host=' . Config::getConfig('database/host') . '; dbname=' . Config::getConfig('database/dbname'), Config::getConfig('database/username'), Config::getConfig('database/password'));
			$this->_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * This function prevents database from multiple connection.
	 * 
	 */
	public static function instantiate()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new Database();
		}

		return self::$_instance;
	} 

	/**
	 * This function is used to insert data into the database
	 * @param  [string] $tableName the name of the table in the database
	 * @param  array  $data      the name of the field with related value to insert into database
	 * @return [type]            [description]
	 */
	public function insert($tableName, $data = array())
	{
		$sql = 'INSERT INTO ' . $tableName . ' (';
		$sql .= implode(',', array_keys($data)) . ') VALUES ( ?';
		for($i = 1; $i < count($data); $i++) {
			$sql .= ',?';
		}
		$sql .= ')';
		$stmt = $this->_connect->prepare($sql);

		try {
			$stmt->execute(array_values($data));
			return $this->_connect->lastInsertId();
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * This function is used to access the table data from database
	 * @param  string $tableName  name of the table in the database
	 * @param  string $columnName name of the column in the database
	 * @param  string $criteria   criteria for selecting the database
	 * @param  array  $bindValue  [description]
	 * @param  string $clause     [description]
	 * @return [type]             [description]
	 */
	public function select($tableName = "", $columnName = "*", $criteria = "", $bindValue = array(), $clause = "")
	{
		$sql = "SELECT " . $columnName . " FROM " . $tableName;
		
		if(!empty($criteria)) {
			$sql .= " WHERE " . $criteria;
		}

		if(!empty($clause)) {
			$sql .= " " . $clause;
		}

		$stmt = $this->_connect->prepare($sql);

		try {
			$stmt->execute($bindValue);
			return $stmt->fetchall(PDO::FETCH_CLASS);
		}catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * This function can be used to execute raw queries
	 * @param  string $query     mysql query
	 * @param  array  $bindValue 
	 * @return [type]            PDO object
	 */
	public function raw($query = '', $bindValue = array())
	{
		$stmt = $this->_connect->prepare($query);
		try {
			$stmt->execute($bindValue);
			return $stmt->fetchall(PDO::FETCH_CLASS);
		}catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * This function is used to update the value in the database
	 * @param  string $tableName name of the table
	 * @param  array  $data      data to be updated
	 * @param  [type] $criteria  [description]
	 * @param  array  $bindValue [description]
	 * @return [type]            [description]
	 */
	public function update($tableName, $data = array(), $criteria, $bindValue = array())
	{
		$sql = 'UPDATE ' . $tableName . ' SET ';
		$sql .= implode('=?,', array_keys($data));
		$sql .= '=? WHERE '. $criteria;
		$exe = array_merge(array_values($data), $bindValue);

		$stmt = $this->_connect->prepare($sql);
		try {
			$stmt->execute($exe);
			return true;
		}catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * This function is used to delete the object from the database
	 * @param  string $tableName  name of the table
	 * @param  [type] $criteria  [description]
	 * @param  array  $bindValue [description]
	 * @return [type]            [description]
	 */
	public function delete($tableName, $criteria, $bindValue = array())
	{
		$sql = 'DELETE FROM ' . $tableName . ' WHERE ' . $criteria;
		$stmt = $this->_connect->prepare($sql);
		try{
			$stmt->execute($bindValue);
			return true;
		}catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	public function countRow($tableName, $criteria = NULL, $bindValue = array()) {
		$sql = 'SELECT count(*) FROM '. $tableName;
		if(!empty($criteria)) {
			$sql .= ' WHERE' . $criteria;
		}
		$stmt = $this->_connect->prepare($sql);
		try{
			$stmt->execute($bindValue);
			$count = $stmt->fetchall(PDO::FETCH_COLUMN);
			return $count[0];
		}catch(PDOException $e) {
			die($e->getMessage());
		}
	}
}