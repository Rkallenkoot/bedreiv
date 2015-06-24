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

	public function getIncidentDateCount(){
		$query = "SELECT count(*) as 'aantal', c.naam, DATE_FORMAT(i.datum, '%d %b') as 'datum' from incident i
		join categorie c on (i.categorie_id = c.id)
		where i.datum between DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()
		group by date(i.datum), i.categorie_id";

		$stmt = $this->dbh->prepare($query);
		try{
			$stmt->execute();
			return $stmt->fetchAll();
		} catch(\PDOException $ex){
			return array();
		}

	}

}