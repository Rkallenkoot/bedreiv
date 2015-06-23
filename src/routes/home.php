<?php
use \models\Hardware;

// Homepage Router
$app->get('/', function() use ($app){
	$app->render('home/index.php');
});

$app->get('/bami', function() use ($app){
	$hardware = new Hardware();

	$result = $hardware->fetchAll();

	$app->render('home/bami.php', array(
		'bami' => $result[2]['id']
		));
});