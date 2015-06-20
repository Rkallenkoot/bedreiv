<?php
namespace models;

use \models\BaseModel;
use PDO;

class Software extends BaseModel {

    /**
     * Fetch Software by $id
     */
    public function findById($id){
        $stmt = $this->dbh->prepare("SELECT * FROM software WHERE id = :id");
        $stmt->execute(array(
            ':id' => $id));

        return $stmt->fetch();
    }

    public function fetchAll(){
        $stmt = $this->dbh->prepare("SELECT * FROM software");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function fetchIdName(){
        $stmt = $this->dbh->prepare("SELECT id, uitgebreide_naam FROM software");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}