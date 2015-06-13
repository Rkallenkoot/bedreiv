<?php
namespace config;

class Config {
	private static $config;

	public static function get($key){
		return self::$config[$key];
	}

	public static function set($key, $value){
		self::$config[$key] = $value;
	}
}