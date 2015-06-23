<?php

namespace models;
use PDO;
use models\BaseModel;

class Soort extends BaseModel{

    public function fetchAll(){
        $stmt = $this->dbh->prepare("select * from soort");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}