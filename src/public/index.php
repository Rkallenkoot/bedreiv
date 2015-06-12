<?php

require '../vendor/autoload.php';
require '../config.php';
// Create app instance
$app = new \Slim\Slim();

// include the routes you want to use

$app->get('/', function(){
	echo "joepie";
});

$app->get('/hello/:name', function($name){
				echo "Hello $name";
});
$app->run();

