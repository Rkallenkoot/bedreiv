<?php

namespace models;
use PDO;
use models\BaseModel;

class Locatie extends BaseModel{

    public function fetchAll(){
        $stmt = $this->dbh->prepare("select * from locatie");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}