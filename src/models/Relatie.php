<?php

namespace models;
use PDO;
use models\BaseModel;

class Relatie extends BaseModel{

    public function fetchAll(){
        $stmt = $this->dbh->prepare("select distinct id, naam, soort_relatie_id from relatie");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}