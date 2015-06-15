<?php
namespace database;

use \config\Config;
use PDO;

class Connection {
	public $db;
	private static $instance;

	protected function __construct(){

		$host = Config::get('db.host');
		$dbname = Config::get('db.dbname');
		$port = Config::get('db.port');
		$connectionString = "mysql:host={$host};dbname={$dbname};port={$port};charset=utf8;connect_timeout=15";

		$user = Config::get('db.user');
		$password = Config::get('db.password');

		$this->db = new PDO($connectionString, $user, $password);

		// Set some default attributes
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}

	/**
	 * Returns the Singleton instance of this Connection class
	 */
	public static function getInstance(){
		if(!is_object(self::$instance)){
			self::$instance = new Connection();
		}
		return self::$instance;
	}

	/**
	 * Methods overwritten so Singleton cannot be Cloned or Unserialized
	 */
	private function __clone(){}
	private function __wakeup(){}

}