<?php
namespace models;

use \models\BaseModel;
use PDO;

class Hardware extends BaseModel {

	/**
	 * Fetch Hardware by $id
	 */
	public function findById($id){
		$stmt = $this->dbh->prepare("SELECT * FROM hardware WHERE id = :id");
		$stmt->execute(array(
			':id' => $id));

		return $stmt->fetch();
	}

	public function fetchAll(){
		$stmt = $this->dbh->prepare("SELECT * FROM hardware");
		$stmt->execute();

		return $stmt->fetchAll();
	}

    public function fetchIds(){
        $stmt = $this->dbh->prepare("SELECT id FROM hardware");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}