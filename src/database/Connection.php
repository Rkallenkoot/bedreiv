<?php
namespace database;

use database\Config;
use PDO;

class Connection {
	public $handler;
	private static $instance;

	private function __construct(){
		$connectionString = 'mysql:host=' . Config::read('db.host') .
		';dbname='. Config::read('db.dbname') .
		';port=' . Config::read('db.port') .
		';connect_timeout=15';

		$user = Config::read('db.user');
		$password = Config::read('db.password');

		$this->handler = new PDO($connectionString, $user, $password);
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