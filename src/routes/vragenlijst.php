<?php
use \models\Vragenlijst;

// Homepage Router
$app->get('/questionnaire/:id', function($id) use ($app){
	$app->render('questionnaire/questionnaire.php', array(
			'questionnumber' => $id
		));
});