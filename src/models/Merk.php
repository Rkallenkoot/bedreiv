<?php

namespace models;
use PDO;
use models\BaseModel;

class Merk extends BaseModel{

    public function fetchAll(){
        $stmt = $this->dbh->prepare("select * from merk");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}