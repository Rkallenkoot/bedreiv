<?php
namespace models;

use \database\Connection;
use PDO;

abstract class BaseModel {

	// Holds the database connection
	protected $conn;
	public $dbh;

	public function __construct(){
		$this->conn = Connection::getInstance();
		$this->dbh = $this->conn->db;
	}

}
