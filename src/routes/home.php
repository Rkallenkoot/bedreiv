<?php
// Homepage Router
$app->get('/', function() use ($app){
	$app->render('home/index.php');
});

$app->get('/bami', function() use ($app){
	$app->render('home/bami.php', array(
		'bami' => 'Ja natuurlijk bami'
		));
});