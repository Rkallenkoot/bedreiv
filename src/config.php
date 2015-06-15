<?php
/**
 * Configuration file
 *
 * Configuration file should be included after $app instantiation
 */
use \config\Config;

/**
 * App configuration
 */
Config::set('app.debug', true);
Config::set('app.mode', 'development');
// templates path relative to public/index.php
Config::set('app.templates.path', '../templates');

/**
 * Database configuration
 */
Config::set('db.host', '127.0.0.1');
Config::set('db.port', 3306);
Config::set('db.dbname', 'database');
Config::set('db.user', 'username');
Config::set('db.password', 'password');
