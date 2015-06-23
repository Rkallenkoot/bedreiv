<?php
use \models\Hardware;
use \models\Soort;
use \models\Locatie;
use \models\Merk;
use \models\Relatie;
use \models\Software;
use \models\HardwareSoftware;


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

		$software = new Software();
		$softwares = $software->fetchAllJoined();

		$hwsw = new HardwareSoftware();
		$attachedSW = $hwsw->findByHardwareId($id);

		$app->render('config/show.php', array(
			'hardware' => $result,
			'soorten' => $soorten,
			'locaties' => $locaties,
			'merken' => $merken,
			'relaties' => $relaties,
			'attachedSW' => $attachedSW[1],
			'software' => $softwares));

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

	$app->post('/hardware/attach', function() use ($app){
		$hwid = $app->request->post('hwid');
		$swid = $app->request->post('swid');

		if($hwid == "" || $swid == ""){
			$app->flash('error', "Er is iets foutgegaan!");
			$app->redirect("/configs/hardware/all");
		}

		// Inserten die HWSW
		$hwsw = new HardwareSoftware();
		$hwsw->insert($hwid, $swid);

		$app->flash('success', "$swid is succesvol gekoppeld aan $hwid!");
		$app->redirect("/configs/hardware/show/$hwid");
	});

	$app->post('/hardware/detach', function() use ($app){
		$hwid = $app->request->post('hwid');
		$swid = $app->request->post('swid');

		if($hwid == "" || $swid == ""){
			$app->flash('error', "Er is iets foutgegaan!");
			$app->redirect("/configs/hardware/all");
		}

		// Inserten die HWSW
		$hwsw = new HardwareSoftware();
		$hwsw->delete($hwid, $swid);

		$app->flash('success', "$swid is succesvol ontkoppeld van $hwid!");
		$app->redirect("/configs/hardware/show/$hwid");
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

	$app->group('/software', function() use ($app){

		$app->get('/all', function() use ($app){
			$software = new Software();
			$softwares = $software->fetchAllJoined(); // hihi softwares


			$app->render('config/software/index.php', array(
				'software' => $softwares));
		});

		$app->get('/create', function() use ($app){
			$soort = new Soort();
			$soorten = $soort->fetchAll();

			$app->render('config/software/create.php', array(
				'soorten' => $soorten));
		});

		$app->post('/create', function() use ($app){
			$id = $app->request->post('id');
			$naam = $app->request->post('naam');

			if($id == "" || $naam == ""){
				$app->flash('error', "Formulier is niet correct ingevuld");
				$app->redirect('/configs/software/create');
			}

			$software = new Software();
			$result = $software->insert(
				$id,
				$naam,
				$app->request->post('soort'),
				$app->request->post('aantallicenties')
				);

			if(!$result[0]){
				$app->flash('error', "Software is niet toegevoegd!<br>".$result[1]);
				$app->redirect('/configs/software/all');
			}
			$app->flash('success', "Software succesvol toegevoegd!");
			$app->redirect('/configs/software/all');

		});

		// Show :id endpoint
		$app->get('/show/:id', function($id) use ($app){
			$soort = new Soort();
			$soorten = $soort->fetchAll();

			$software = new Software();
			$soft = $software->findById($id);

			$app->render('config/software/show.php', array(
				'software' => $soft,
				'soorten' => $soorten));
			// Roelof je ging deze invullen
		});

		// Update endpoint
		$app->post('/update', function() use ($app){
			$id = $app->request->post('id');
			$naam = $app->request->post('naam');
			$soort = $app->request->post('soort');
			$aantal = $app->request->post('aantallicenties');

			if($id == "" || $id == null){
				$app->flash('error', 'Formulier niet goed ingevuld');
				$app->redirect("/configs/software/show/$id");
			}

			$software = new Software();
			$result = $software->update($id, $naam, $soort, $aantal);

			if(!$result[0]){
				$app->flash('error', "Software is niet gewijzigd!<br>".$result[1]);
				$app->redirect('/configs/software/all');
			}
			$app->flash('success', "Software succesvol gewijzigd!");
			$app->redirect('/configs/software/all');

		});

		// Delete endpoint
		$app->post('/delete', function() use ($app){
			$id = $app->request->post('id');

			if($id == "" || $id == null){
				$app->flash('error', 'Software kon niet worden verwijderd.');
				$app->redirect('/configs/software/all');
			}

			$software = new Software();
			$software->delete($id);
			$app->flash('success', 'Software succesvol verwijderd!');
			$app->redirect('/configs/software/all');
		});


	});


});


?>