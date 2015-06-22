<?php

$app->map('/login', function() use ($app){
	$username = null;

	if($app->request()->isPost()){
		$username = $app->request->post('username');
		$password = $app->request->post('password');

		$result = $app->authenticator->authenticate($username, $password);

		if($result->isValid()){
			$app->redirect('/incidents/all');
		} else {
			$messages = $result->getMessages();
			$app->flashNow('error', $messages[0]);
		}
	}

	$app->render('auth/login.php', array('username'=> $username));
})->via('GET', 'POST')->name('login');


// Logout Route
$app->get('/logout', function () use ($app) {
	if ($app->auth->hasIdentity()) {
		$app->auth->clearIdentity();
	}
	$app->redirect('/');
});

