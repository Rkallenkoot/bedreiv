<?php
namespace models;

use \models\BaseModel;
use PDO;

class Status extends BaseModel {

    /**
     * Fetch Status by $id
     */
    public function findById($id){
        $stmt = $this->dbh->prepare("SELECT * FROM status WHERE id = :id");
        $stmt->execute(array(
            ':id' => $id));

        return $stmt->fetch();
    }

    public function fetchAll(){
        $stmt = $this->dbh->prepare("SELECT * FROM status");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function fetchIdNames(){
        $stmt = $this->dbh->prepare("SELECT id ,naam FROM status");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}