<?php
use \config\Config;

require '../vendor/autoload.php';
require '../config.php';
// Create the app instance
$app = new \Slim\Slim(array(
	'mode' => Config::get('app.mode'),
	'debug' => Config::get('app.debug'),
	'templates.path' => Config::get('app.templates.path')
	));

// include the routes you want to use
// we could do this with some loop, this way we have more control
require '../routes/home.php';

// Run the app
$app->run();

