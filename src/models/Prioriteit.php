<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 20/06/15
 * Time: 21:33
 */

namespace models;
use PDO;
use models\BaseModel;

class Prioriteit extends BaseModel{

    public function fetchPriorities(){
        $stmt = $this->dbh->prepare("select id,naam from prioriteit");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}