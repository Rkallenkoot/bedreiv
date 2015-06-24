<?php
use \models\Vragenlijst;

// Homepage Router
$app->get('/questionnaire/:id', function($id) use ($app){
	$vragenlijst = new Vragenlijst();
	$result = $vragenlijst->getAll();
	$app->render('questionnaire/questionnaire.php', array(
			'questionid' => $id,
			'question_db' => $result[$id - 1]	
		));
});

$app->get('/questionnaire', function() use ($app){
	$app->render('questionnaire/questionnaire.php');
});

$app->get('/questionnaire_finished', function() use ($app){
	$app->render('questionnaire/questionnaire_finished.php');
});