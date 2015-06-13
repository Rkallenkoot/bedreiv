<?php
namespace database;

use \config\Config;
use PDO;

class Connection {
	public $db;
	private static $instance;

	private function __construct(){
		$connectionString = 'mysql:host=' . Config::get('db.host') .
		';dbname='. Config::get('db.dbname') .
		';port=' . Config::get('db.port') .
		';connect_timeout=15';

		$user = Config::get('db.user');
		$password = Config::get('db.password');

		$this->db = new PDO($connectionString, $user, $password);
	}

	/**
	 * Returns the Singleton instance of this Connection class
	 */
	public static function getInstance(){
		if(null === static::$instance){
			static::$instance == new static();
		}
		return static::$instance;
	}

	/**
	 * Methods overwritten so Singleton cannot be Cloned or Unserialized
	 */
	private function __clone(){}
	private function __wakeup(){}

}