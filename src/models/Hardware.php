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

	public function fetchALlJoined(){
		$stmt = $this->dbh->prepare("SELECT h.id as 'id',h.jaar_van_aanschaf as 'jaar_van_aanschaf', s.naam as 'soort', m.naam as 'merk', l.lokaal as 'locatie', r.naam as 'relatie'
			FROM hardware h
			join soort s on (h.soort_id = s.id)
			join merk m on (h.merk_id = m.id)
			join locatie l on (h.locatie_id = l.id)
			join relatie r on (h.relatie_id = r.id)");

		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function fetchByID($id){
		$query = "SELECT h.id as 'id',h.jaar_van_aanschaf as 'jaar_van_aanschaf', s.naam as 'soort', m.naam as 'merk', l.lokaal as 'locatie', r.naam as 'relatie'
			FROM hardware h
			join soort s on (h.soort_id = s.id)
			join merk m on (h.merk_id = m.id)
			join locatie l on (h.locatie_id = l.id)
			join relatie r on (h.relatie_id = r.id)
			where h.id =:id";

		
		$stmt = $this->dbh->prepare($query);
		$stmt->execute(array('id'=> $id));
		return $stmt->fetchAll();
	}

	public function fetchIds(){
		$stmt = $this->dbh->prepare("SELECT id FROM hardware");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function addHardware($hardware_id, $jaarvanaanschaf,$soort_id, $locatie_id, $merk_id, $relatie_id){

        // Construct Query
		$query = "insert into hardware (id, jaar_van_aanschaf, soort_id, locatie_id, merk_id, relatie_id)
		values (:hardware_id, :jaar_van_aanschaf, :soort_id, :locatie_id, :merk_id, :relatie_id)";

		$stmt = $this->dbh->prepare($query);
		$stmt->execute(array(
			':hardware_id' => $hardware_id,
			':jaar_van_aanschaf' => $jaarvanaanschaf,
			':soort_id' => $soort_id,
			':locatie_id' => $locatie_id,
			':merk_id' => $merk_id,
			':relatie_id' => $relatie_id
			));
	}

}