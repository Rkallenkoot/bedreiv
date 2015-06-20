<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 20/06/15
 * Time: 12:14
 * @author Kevin Lankhuizen
 */

namespace models;

use \models\BaseModel;
use PDO;

class Incident extends BaseModel {

    /*
     * Get all the incidents
     * @param int $min  Minimum id to show, default 0
     * @param int $max  Maximum id to show, default 50
     */
    public function getAll(){

        // Construct query
        $query = "select i.id, i.datum, i.user_id, i.assigned_to, i.omschrijving, i.hardware_id, i.prioriteit_id
                  from incident i
                  ";

        // Prepare statement
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*
     * Get a specific item from the database
     * @param id The Incident ID
     */
    public function getItemById($id)   {

        // Construct query
        $query = "select i.id, i.datum, i.user_id, i.assigned_to, i.omschrijving, i.hardware_id, i.prioriteit_id
                  from incident i
                  where i.id = :id";

        // Prepare statement
        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
           ':id' => $id
        ));

        return $stmt->fetch();
    }

    /*
     *   Add an incident
     */
    public function addIncident($date_start, $date_finished, $user_id, $assigned_to, $description, $workaround, $priority_id, $hardware_id, $software_id, $category_id, $status){
        // Construct Query
        $query = "insert into incident (datum, datum_afgerond, user_id, assigned_to, omschrijving, workaround, prioriteit_id, hardware_id, software_id, categorie_id, status)
                values (':date' ':date_fin' ':user_id', ':assigned_to', ':omschrijving', ':workaround', ':prio', ':hardware_id', ':software_id', ':cat_id', ':status')";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
            ':date' => $date_start,
            ':date_fin' => $date_finished,
            ':user_id' => $user_id,
            ':assigned_to' => $assigned_to,
            ':omschrijving' => $description,
            ':workaround' => $workaround,
            ':prio' => $priority_id,
            ':hardware_id' => $hardware_id,
            ':software_id' => $software_id,
            ':cat_id' => $category_id,
            ':status' => $status
        ));

    }

    /*
     * This function will update a row in the database
     */
    public function updateIncident($id, $date_finished, $user_id, $assigned_to, $description, $workaround, $priority_id, $hardware_id, $software_id, $category_id, $status){

        $query = "update incidents set
                  datum_afgerond=':date_finisned',
                  user_id = ':user_id',
                  assigned_to = ':assigned_to',
                  omschrijving = ':omschrijving',
                  workaround = ':workaround',
                  prioriteit_id = ':prio',
                  hardware_id = ':hardware_id',
                  software_id = ':software_id',
                  categorie_id = ':cat_id',
                  status = ':status'
                  where id = :id";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(

            ':date_fin' => $date_finished,
            ':user_id' => $user_id,
            ':assigned_to' => $assigned_to,
            ':omschrijving' => $description,
            ':workaround' => $workaround,
            ':prio' => $priority_id,
            ':hardware_id' => $hardware_id,
            ':software_id' => $software_id,
            ':cat_id' => $category_id,
            ':status' => $status,
            ':id' => $id
        ));

    }



}