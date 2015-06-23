<?php
namespace models;

use PDO;
use models\BaseModel;

/*
SELECT s.id, s.uitgebreide_naam as 'naam'
FROM hardware h
join hardware_software hs on (h.id = hs.hardware_id)
join software s on (hs.software_id = s.id)
where h.id = 'HFK003'
*/

class HardwareSoftware extends BaseModel{

	public function findByHardwareId($id){
		$query = "SELECT s.id, s.uitgebreide_naam as 'naam'
		FROM hardware h
		join hardware_software hs on (h.id = hs.hardware_id)
		join software s on (hs.software_id = s.id)
		where h.id = :id";
		$stmt = $this->dbh->prepare($query);
		try {
			$stmt->execute(array(
				':id' => $id));
			return array(true, $stmt->fetchAll());
		} catch(\PDOException $ex){
			return array(false, $ex->getMessage());
		}
	}

	/**
		* Insert record into hardware_software pivot table
		* @param $hwid Hardware id
		* @param $swid Software id
		*/
	public function insert($hwid, $swid){
		$query = "INSERT INTO hardware_software (hardware_id, software_id)
		VALUES (:hwid, :swid)";

		$stmt = $this->dbh->prepare($query);
		try {
			$stmt->execute(array(
				':hwid' => $hwid,
				':swid' => $swid));
			return array(true);
		} catch (\PDOException $ex){
			return array(false, $ex->getMessage());
		}
	}

	/**
		* Delete record from hardware_software pivot table
		* @param $hwid Hardware id
		* @param $swid Software id
		*/
	public function delete($hwid, $swid){
		$query = "DELETE FROM hardware_software where (hardware_id = :hw and software_id = :sw)";

		$stmt = $this->dbh->prepare($query);
		try {
			$stmt->execute(array(
				':hw' => $hwid,
				':sw' => $swid));
			return array(true);
		} catch (\PDOException $ex){
			return array(false, $ex->getMessage());
		}
	}

}