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

$app->get('/incidents', function() use ($app){


    $incidents = new Incident();

    $result = $incidents->getAll();

    $app->render('incident/show_all.php', array(
      'data' => $result
    ));


});
