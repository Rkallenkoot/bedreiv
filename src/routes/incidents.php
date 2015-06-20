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
$app->get('/incidents', function() use ($app){
    $incidents = new Incident();
    // When we have clicked the Change button
    if ($app->request()->isPost()){
        $hardware = new \models\Hardware();
        $software = new \models\Software();
        $status = new \models\Status();
        $user = new \models\User();

        $incident_id = $app->request->post('incident_id');
        $result = $incidents->getItemById($incident_id);




        $app->render('incident/show.php', array(
            'data' => $result,
            'hardware' => $hardware->fetchIds(),
            'software' => $software->fetchIdName(),
            'status' => $status->fetchIdNames(),
            'users' => $user->fetchUserNames()
        ));

    }

    else {


        $result = $incidents->getAll();

        $app->render('incident/show_all.php', array(
            'data' => $result
        ));

    }
})->via('GET', 'POST');

// We are updating an entry
$app->get('/incident_update', function() use ($app){
    $incidents = new Incident();

    if ($app->request()->isPost()){

        $incidents->updateIncident(
            $app->request->post('id'),
            $app->request->post('datum'),
            $app->request->post('user_id'),
            $app->request->post('assigned_to'),
            $app->request->post('omschrijving'),
            $app->request->post('workaround'),
            $app->request->post('prioriteit_id'),
            $app->request->post('hardware_id'),
            $app->request->post('software_id'),
            $app->request->post('categorie_id'),
            $app->request->post('status')
        );
        $app->redirect('/incidents');
    }
    else {
        $app->redirect('/incidents');
    }
})->via('GET', 'POST');
