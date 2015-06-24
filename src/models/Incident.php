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
        $query = "select i.id, i.datum, i.datum_afgerond,p.naam, i.workaround, i.omschrijving, i.hardware_id, i.software_id, s.naam as status, i.status as status_id
                  from incident i
                  join prioriteit p on p.id = i.prioriteit_id
                  left join status s on s.id = i.status
                  order by status_id asc, p.id desc, i.datum desc

                  ";

        // Prepare statement
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*
   * Get all the incidents by userID or role
   *
   *
   */
    public function getAllByUserId($user_id){

        // Construct query
        $query = "select i.id, i.datum, i.datum_afgerond,p.naam, i.workaround, i.omschrijving, i.hardware_id, i.software_id, s.naam as status
                  from incident i
                  join prioriteit p on p.id = i.prioriteit_id

                  left join status s on s.id = i.status
                  where i.user_id = :user_id
                  ";

        // Prepare statement
        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
            ':user_id' => $user_id
        ));

        return $stmt->fetchAll();
    }
    // -- Vergelijkbare omschrijvingen met zelfde hardware/software doen
    public function compareIncidents($own_id, $software_id = null, $hardware_id = null, $omschrijving = null){
        $q = "
            select i.id, i.hardware_id, i.omschrijving, s.uitgebreide_naam, i.workaround
            from incident i
            left join software s on i.software_id = s.id
            where i.id in (
            select i2.id
            from incident i2
            join software s2 on i2.software_id = s2.id
            where s2.id = :software_id AND i.id != :own_id
            )
            OR
            i.id in (
            select i3.id
            from incident i3
            join hardware h on i3.hardware_id = h.id
            where h.id = :hardware_id AND i.id != :own_id
            )
            OR i.id in (
            select i4.id
            from incident i4
            where omschrijving = :omschrijving AND i.id != :own_id
	        )
        ";

        $stmt = $this->dbh->prepare($q);
        $stmt->execute(array(
            ':software_id' => $software_id,
            ':hardware_id' => $hardware_id,
            ':omschrijving' => $omschrijving,
            ':own_id' => $own_id
        ));

        return $stmt->fetchAll();
    }


    /*
     * Get a specific item from the database
     * @param id The Incident ID
     */
    public function getItemById($id)   {

        // Construct query
        $query = "select i.id, i.datum, i.user_id, i.assigned_to, i.omschrijving, i.hardware_id, u.username, i.prioriteit_id, i.datum_afgerond, i.workaround, i.software_id, i.status, i.categorie_id, io.beschrijving, s.naam as statusnaam
                  from incident i
                  join user u on u.id = i.user_id
                  left join incident_opmerking io on io.incident_id = i.id
                  join status s on s.id = i.status
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
        $incident = new Incident();

        // Construct Query
        $query = "insert into incident (datum, user_id, omschrijving, prioriteit_id, hardware_id, software_id, categorie_id, status)
                values (now(), :user_id, :omschrijving, :prio, :hardware_id, :software_id, :cat_id, :status)";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
            ':user_id' => $user_id,
            ':omschrijving' => $description,
            ':prio' => 1,
            ':hardware_id' => $hardware_id,
            ':software_id' => $software_id == 'null' ? null : $software_id,
            ':cat_id' => $category_id,
            ':status' => 1
        ));

        /* Insert opmerking er na */
        $query = "insert into incident_opmerking(beschrijving, datum, incident_id) values (:beschrijving, now(), :incident_id)";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(
            ':beschrijving' => 'Geen Opmerking',
            ':incident_id' => $incident->getLastFromUser($user_id)['id']
        ));

    }

    public function getLastFromUser($id) {
        $stmt = $this->dbh->prepare("select max(id) as id from incident where user_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));

        return $stmt->fetch();
    }

    /*
     * This function will update a row in the database
     */
    public function updateIncident($id, $user_id, $assigned_to, $description, $workaround, $priority_id, $hardware_id, $software_id, $category_id, $status, $opmerking){


        $query = "update incident i
                  left join incident_opmerking io on i.id = io.incident_id
                  set

                  i.user_id = :user_id,
                  i.assigned_to = :assigned_to,
                  i.omschrijving = :omschrijving,
                  i.workaround = :workaround,
                  i.prioriteit_id = :prio,
                  i.hardware_id = :hardware_id,
                  i.software_id = :software_id,
                  i.categorie_id = :cat_id,
                  i.status = :status,
                  io.beschrijving = :opmerking,
                  io.incident_id = :ioIncidentId
                  where i.id = :id";

        $stmt = $this->dbh->prepare($query);
        $stmt->execute(array(


            ':user_id' => $user_id,
            ':assigned_to' => $assigned_to,
            ':omschrijving' => $description,
            ':workaround' => $workaround,
            ':prio' => $priority_id,
            ':hardware_id' => $hardware_id,
            ':software_id' => $software_id == 'null' ? null : $software_id,
            ':cat_id' => $category_id,
            ':status' => $status,
            ':opmerking' => $opmerking,
            ':ioIncidentId' => $id,
            ':id' => $id

        ));


    }

    /*
     * This function will close a ticket, and set a date
     */
    public function rondAf($id){
        $stmt = $this->dbh->prepare("update incident set datum_afgerond = now(), status = 3 where id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
    }

    public function fetchOpenCount(){
    	$query = "SELECT COUNT(*) as 'open' from incident WHERE status = 1";

    	$stmt = $this->dbh->prepare($query);
    	$stmt->execute();
    	return $stmt->fetch();
    }

}
