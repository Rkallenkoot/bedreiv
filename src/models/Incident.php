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
        $query = "select i.id, i.datum, i.datum_afgerond,p.naam, i.workaround, i.omschrijving, i.hardware_id, i.software_id
                  from incident i
                  join prioriteit p on p.id = i.prioriteit_id

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
        $query = "select i.id, i.datum, i.user_id, i.assigned_to, i.omschrijving, i.hardware_id, i.prioriteit_id, i.datum_afgerond, i.workaround, i.software_id, i.status, i.categorie_id
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
    public function addIncident($user_id, $description,$hardware_id, $software_id, $category_id, $status){
        // Construct Query
        $query = "insert into incident ( user_id, omschrijving, prioriteit_id, hardware_id, software_id, categorie_id, status)
                values (:user_id, :omschrijving, :prio, :hardware_id, :software_id, :cat_id, :status)";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
            ':user_id' => $user_id,
            ':omschrijving' => $description,
            ':prio' => 1,
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


        $query = "update incident set
                  datum_afgerond=:date_finished,
                  user_id = :user_id,
                  assigned_to = :assigned_to,
                  omschrijving = :omschrijving,
                  workaround = :workaround,
                  prioriteit_id = :prio,
                  hardware_id = :hardware_id,
                  software_id = :software_id,
                  categorie_id = :cat_id,
                  status = :status
                  where id = :id";

        $stmt = $this->dbh->prepare($query);

        $stmt->execute(array(

            ':date_finished' => $date_finished,
            ':user_id' => $user_id,
            ':assigned_to' => $assigned_to,
            ':omschrijving' => $description,
            ':workaround' => $workaround,
            ':prio' => $priority_id,
            ':hardware_id' => $hardware_id,
            ':software_id' => $software_id == 'null' ? null : $software_id,
            ':cat_id' => $category_id,
            ':status' => $status,
            ':id' => $id
        ));


    }

}
