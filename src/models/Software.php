<?php
namespace models;

use \models\BaseModel;
use PDO;

class Software extends BaseModel {

		/**
		 * Fetch Software by $id
		 */
		public function findById($id){
			$stmt = $this->dbh->prepare("SELECT * FROM software WHERE id = :id");
			$stmt->execute(array(
				':id' => $id));

			return $stmt->fetch();
		}

		public function fetchAll(){
			$stmt = $this->dbh->prepare("SELECT * FROM software");
			$stmt->execute();

			return $stmt->fetchAll();
		}

		public function fetchAllJoined(){
			$stmt = $this->dbh->prepare("SELECT s.id, s.uitgebreide_naam as 'naam', soort.naam as 'soort', aantal_licenties as 'aantal' from software s join soort on (s.soort_id = soort.id)");

			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function fetchExcludedByHardwareId($id){
			$query = "SELECT distinct s.id, s.uitgebreide_naam as 'naam'
			from software s join hardware_software hs on (hs.software_id = s.id)
			where s.id NOT IN (
				SELECT software_id from hardware_software where hardware_id = :id)";
			$stmt = $this->dbh->prepare($query);
			try {
				$stmt->execute(array(
					':id' => $id));
				return $stmt->fetchAll();
			} catch(\PDOException $ex){
				return array();
			}
		}

		public function fetchIdName(){
			$stmt = $this->dbh->prepare("SELECT id, uitgebreide_naam FROM software");
			$stmt->execute();

			return $stmt->fetchAll();
		}

		// Insert software
		public function insert($id, $naam, $soort, $aantal_licenties){
			$query = "INSERT INTO software VALUES (:id, :naam, :soort, :aantal)";
			$stmt = $this->dbh->prepare($query);
			try {
				return array($stmt->execute(array(
					':id' => $id,
					':naam' => $naam,
					':soort' => $soort,
					':aantal' => $aantal_licenties)));
			} catch (\PDOException $ex){
				return array(false, $ex->getMessage());
			}
		}

		// DELETE FUNCTIE PLS
		public function delete($id){
			$query = "DELETE FROM software where id = :id";
			$stmt = $this->dbh->prepare($query);
			try {
				$stmt->execute(array(
					':id' => $id));
				// Return true als het is gelukt
				return array(true);
			}
			catch(\PDOException $ex){
				// Return false met error message
				return array(false, $ex->getMessage());
			}
		}

		// Update software
		public function update($id, $naam, $soort, $aantal){
			$query = "UPDATE software SET uitgebreide_naam = :naam, soort_id = :soort, aantal_licenties = :aantal where id = :id";
			$stmt = $this->dbh->prepare($query);
			try {
				$stmt->execute(array(
					':id' => $id,
					':naam' => $naam,
					':soort' => $soort,
					':aantal' => $aantal));
				return array(true);
			} catch (\PDOException $ex){
				return array(false, $ex->getMessage());
			}
		}

	}