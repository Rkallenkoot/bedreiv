<?php
use \models\Hardware;
use \models\Soort;
use \models\Locatie;
use \models\Merk;
use \models\Relatie;


use \JeremyKendall\Slim\Auth\HttpForbiddenException;

$app->group('/configs', function() use ($app){

	$app->get("/hardware/all", function() use ($app){

		$hardware = new Hardware();
		$result = $hardware->fetchAllJoined();

		$app->render('config/index.php', array(
			'hardware' => $result,
			));

	});

	$app->get("/hardware/show/:id", function($id) use ($app){
		$soort = new Soort();
		$soorten = $soort->fetchAll();

		$locatie = new Locatie();
		$locaties = $locatie->fetchAll();

		$merk = new Merk();
		$merken = $merk->fetchAll();

		$relatie = new Relatie();
		$relaties = $relatie->fetchAll();

		$hardware = new Hardware();
		$result = $hardware->fetchByID($id);

		$app->render('config/show.php', array(
			'hardware' => $result,
			'soorten' => $soorten,
			'locaties' => $locaties,
			'merken' => $merken,
			'relaties' => $relaties
			));

	});

	$app->get('/hardware/create', function() use ($app) {

		$soort = new Soort();
		$soorten = $soort->fetchAll();

		$locatie = new Locatie();
		$locaties = $locatie->fetchAll();

		$merk = new Merk();
		$merken = $merk->fetchAll();

		$relatie = new Relatie();
		$relaties = $relatie->fetchAll();

		$app->render('config/new.php', array(
			'soorten' => $soorten,
			'locaties'=> $locaties,
			'merken' => $merken,
			'relaties' => $relaties));
	});

	$app->post('/hardware/create', function() use ($app){
		$hardware = new Hardware();
		$id = $app->request->post('id');
		if($id == ""){
			// redirecten als hardware id niet is ingevuld
			$app->flash("error", "Hardware id is niet ingevuld");
			$app->redirect('/configs/hardware/create');
		}

		$hardware->addHardware(
			$id,
			$app->request->post('jaarvanaanschaf'),
			$app->request->post('soort'),
			$app->request->post('locatie'),
			$app->request->post('merk'),
			$app->request->post('relatie')
			);

		$app->redirect('/configs/hardware/all');
	});

	$app->post('/hardware/update', function() use ($app){
		$id = $app->request->post('id');

		if($id == ""){
			$app->flash("Error", "Hardware id is niet ingevuld.");
			$app->redirect("/configs/hardware/show/$id");
		}

		// Update hardware
		$hardware = new Hardware();

		$result = $hardware->update(
			$id,
			$app->request->post('jaarvanaanschaf'),
			$app->request->post('soort'),
			$app->request->post('merk'),
			$app->request->post('locatie'),
			$app->request->post('relatie')
			);

		// Als update is mislukt
		if(!$result){
			$app->flash('error', "Updaten is mislukt");
			$app->redirect("/configs/hardware/show/$id");
		}

		$app->redirect('/configs/hardware/all');

	});

});


?>