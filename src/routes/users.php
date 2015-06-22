<?php

use \models\User;

$app->group('/users', function() use ($app){

	// Shows all the users
	$app->get('/all', function() use ($app){
		$app->render('users/all.php');
	});

	// Shows form to create a new user
	$app->get('/create', function() use ($app){
		$user = new User();
		$userRoles = $user->fetchRoles();

		$app->render('users/create.php',array(
			'roles' => $userRoles,
			'username' => ''));
	});

	// Post location to create a new user
	$app->post('/create', function() use ($app){

		// check if values are correct
		$username = $app->request->post('username');
		$role = $app->request->post('role');
		$password = $app->request->post('password');
		if($username == "" || $role == "" || $password  == ""){
			$app->flash('error', 'Vul het formulier correct in');
			$app->redirect('/users/create');
		}
		// inserten die handel
		$user = new User();
		$result = $user->insertUser($username, $password, $role);

		// If succesfull user inserted
		if($result){
			$app->redirect('/users/all');
		} else {
			// User not succesfully inserted
			$app->redirect('/users/create', array(
				'username' => $username));
		}
		// Redirect naar alle users overzicht
	});


	// Shows individual user
	$app->get('/show/:id', function() use ($app){

	});


});