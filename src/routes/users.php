<?php

use \models\User;

$app->group('/users', function() use ($app){

	// Shows all the users
	$app->get('/all', function() use ($app){
		$user = new User();
		$users = $user->fetchAll();

		$app->render('users/index.php', array(
			'users' => $users));
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

	// Update the user
	$app->post('/update', function() use ($app){
		$user = new User();

		$id = $app->request->post('id');

		$result = $user->update(
			$id,
			$app->request->post('username'),
			$app->request->post('role'),
			$app->request->post('password')
			);

		if(!$result){
			$app->flash('error', "Updaten is mislukt");
			$app->redirect("/users/show/$id");
		}

		$app->redirect('/users/all');
	});


	// Shows individual user
	$app->get('/show/:id', function($id) use ($app){
		$user = new User();
		$userRoles = $user->fetchRoles();
		$userInfo = $user->fetchByID($id);

		$app->render('users/show.php', array(
			'roles' => $userRoles,
			'user' => $userInfo
			));

	});

	$app->post('/delete', function() use ($app){
		$id = $app->request->post('id');
		$user = new User();
		$user->delete($id);

		$app->redirect('/users/all');
	});


});