<?php
use \models\Incident;
/**
 * @author Kevin Lankhuizen
 *
 * This class will list the incidents, and the manager is able to click, sort and view
 * all incidents available.
 *
 * Functionality included :
 *
 *  -   List incidents
 *  -   Select individual incidents
 *  -   View incidents with common problems ( and show the probable causes )
 *
 */


// Normal Incidents Route

$app->group('/incidents', function() use ($app){
	// Show all incidents
	$app->get('/all', function() use ($app){
		$incident = new Incident();
        $identity = $app->auth->getIdentity();
        if ($identity['role'] == 'admin'){
            $result = $incident->getAll();
        } else {
            $result = $incident->getAllByUserId($identity['id']);
        }

		$app->render('incident/show_all.php', array(
			'data' => $result
			));
	});

	// Show 1 incident
	$app->get('/show/:id', function($id) use ($app){
		$incident = new Incident();
		$hardware = new \models\Hardware();
		$software = new \models\Software();
		$status = new \models\Status();
		$user = new \models\User();
        $prioriteiten = new \models\Prioriteit();

        $identity = $app->auth->getIdentity();
        $result = $incident->getItemById($id);

        /*
         * Checking if user is the owner of the ticket OR the user is an admin
         * If user is, show the ticket
         * If not, send back to incidents/all
         */
        if ($identity['role'] == 'admin') {

            $app->render('incident/show.php', array(
                'data' => $result,
                'title' => "Incident - $id",
                'hardware' => $hardware->fetchIds(),
                'software' => $software->fetchIdName(),
                'status' => $status->fetchIdNames(),
                'users' => $user->fetchUserNames(),
                'prioriteiten' => $prioriteiten->fetchPriorities()
            ));

        } else if ($identity['id'] == $result['user_id']) {
            $app->render('incident/show_user.php', array(
                'data' => $result,
                'title' => "Incident - $id",
                'hardware' => $hardware->fetchIds(),
                'software' => $software->fetchIdName(),
                'status' => $status->fetchIdNames(),
                'users' => $user->fetchUserNames(),
                'prioriteiten' => $prioriteiten->fetchPriorities()
            ));

        } else {
            $app->redirect('/incidents/all');
        }
	});

	// update incident
	$app->post('/update', function() use ($app){
		$incident = new Incident();
        $temp = $incident->getItemById($app->request->post('id'));
        if ($app->auth->getIdentity()['role'] == 'admin'){

            $incident->updateIncident(
                $app->request->post('id'),
                $app->request->post('user_id'),
                $app->request->post('assigned_to'),
                $app->request->post('omschrijving'),
                $app->request->post('workaround'),
                $app->request->post('prioriteit_id'),
                $app->request->post('hardware_id'),
                $app->request->post('software_id'),
                $app->request->post('categorie_id'),
                $app->request->post('status'),
                $app->request->post('opmerking')
            );

            $app->redirect('/incidents/all'


            );

        } else {
            $incident->updateIncident(
                $app->request->post('id'),
                $app->request->post('datum'),
                $app->request->post('user_id'),
                $temp['assigned_to'],
                $app->request->post('omschrijving'),
                $app->request->post('workaround'),
                $temp['prioriteit_id'],
                $app->request->post('hardware_id'),
                $app->request->post('software_id'),
                $app->request->post('categorie_id'),
                $temp['status'],
                $app->request->post('opmerking')

            );

            // We can flash some info here about the update
            $app->redirect('/incidents/all');
        }
	});

    // Close incident
    $app->post('/close', function() use ($app){
        $incident = new Incident();
        // make sure the user is authorized
        if ($app->auth->getIdentity()['role'] == 'admin'){
            $incident->rondAf($app->request->post('id'));
            $app->redirect('/incidents/all');
        }
        else {
            $app->redirect('/incidents/all');
        }

    });

});

$app->get('/incident_new', function() use ($app){

    // We need to provide hardware_ids and software_ids
	$hardware = new \models\Hardware();
	$software = new \models\Software();
	$categorie = new \models\Categorie();

	if ($app->request()->isPost()){
		$incidents = new Incident();

        $incidents->addIncident(
            $app->request->post('user_id'),
            $app->request->post('omschrijving'),
            $app->request->post('hardware_id'),
            $app->request->post('software_id'),
            $app->request->post('categorie_id'),
            $app->request->post('status')
        );

        $app->redirect('incidents/all');
    }

    $app->render('incident/new.php', array(
        'hardware' => $hardware->fetchIds(),
        'software' => $software->fetchIdName(),
        'categorie' => $categorie->fetchCategories()
    ));
})->via('GET', 'POST');
