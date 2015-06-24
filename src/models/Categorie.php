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

class Categorie extends BaseModel{

	public function fetchCategories(){
		$stmt = $this->dbh->prepare("select * from categorie");
		$stmt->execute();

		return $stmt->fetchAll();
	}

}