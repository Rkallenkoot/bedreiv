<?php
use \models\Vragenlijst;

// Homepage Router
$app->get('/vragenlijst', function() use ($app){
	$app->render('vragenlijst/startpage.php');
});