<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 24/06/15
 * Time: 12:24
 */


namespace models;

use \models\BaseModel;
use PDO;

class Opmerking extends BaseModel{

    public function getMessages($id){

        $stmt = $this->dbh->prepare('select b.datum, b.id, b.beschrijving, u.username from incident_opmerking b join user u on b.from_user = u.id where b.incident_id = :incident order by datum asc');
        $stmt->execute(array(
            ':incident' => $id
        ));

        return $stmt->fetchAll();
    }

    public function newMessage($incident, $userId, $body){

        $stmt = $this->dbh->prepare('
            insert into incident_opmerking (beschrijving,datum, incident_id, from_user) values (:body, now(), :incident, :userID)
        ');

        $stmt->execute(array(
            ':incident' => $incident,
            ':userID' => $userId,
            ':body' => $body
        ));



    }

}