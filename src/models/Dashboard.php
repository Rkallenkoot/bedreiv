<?php
namespace models;
use \models\BaseModel;
use PDO;


class Dashboard extends BaseModel {


		// For dashboard statistics
	public function getIncidentCategoryCount(){
		$query = "SELECT i.categorie_id, c.naam, count(*) as 'aantal'
		from incident i
		join categorie c on (c.id = i.categorie_id)
		where (i.datum BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW())
		group by i.categorie_id";

		$stmt = $this->dbh->prepare($query);
		try {
			$stmt->execute();
			return $stmt->fetchAll();
		} catch(\PDOException $ex){
			// empy array on error
			return array();
		}
	}
}