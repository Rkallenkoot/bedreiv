<?php

namespace models;

use \models\BaseModel;
use PDO;

class Vragenlijst extends BaseModel {

   public function getAll(){

        // Construct query
        $query = "select * from vragen v";

        // Prepare statement
        $stmt = $this->dbh->prepare($query);
        $stmt-> execute();

        return $stmt->fetchAll();
    }
}