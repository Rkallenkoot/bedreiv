<?php

namespace models;

use \models\BaseModel;
use PDO;

class User extends BaseModel {

	public function findByUsername($username){
		$stmt = $this->dbh->prepare("SELECT * FROM user WHERE username = :username");
		$stmt->execute(array(
			'username' => $username));

		return $stmt->fetch();
	}

	/**
		* Fetches all users excluding the password ( for obvious reasons )
		* @param $order Order of the list defaults to 'ASC'
		*/
		public function fetchAll($by = 'username', $order = 'ASC'){
			$stmt = $this->dbh->prepare("SELECT id, username, role, created FROM user ORDER BY :username :order");

			$stmt->execute(array(
				':username' => $by,
				':order' => $order));
			return $stmt->fetchAll();
		}

		public function fetchRoles(){
			$stmt = $this->dbh->prepare("SELECT DISTINCT role from user ORDER BY role DESC");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function insertUser($username, $password, $role){
			$stmt = $this->dbh->prepare("INSERT INTO user (username, password, role)
				VALUES (:username, :password, :role)");

			// Hash password
			$passwordhash = password_hash($password, PASSWORD_DEFAULT);

			// Returns true when inserted succesfully
			return $stmt->execute(array(
				':username' => $username,
				':password' => $passwordhash,
				':role' => $role
				));
		}

		public function update($id, $username, $role, $password){
			$passwordHash = password_hash($password, PASSWORD_DEFAULT);

			$stmt = $this->dbh->prepare("UPDATE user
				set username = :username,
				role = :role,
				password = :password
				where id = :id");

			return $stmt->execute(array(
				':username' => $username,
				':role' => $role,
				':password' => $passwordHash,
				':id' => $id));
		}

		public function fetchByID($id){
			$stmt = $this->dbh->prepare("SELECT id, username, role, created from user where id = :id");

			$stmt->execute(array(':id' => $id));
			return $stmt->fetch();
		}

		public function delete($id){
			// check admin user
			$stmt = $this->dbh->prepare("SELECT id from user where username = 'admin'");
			$stmt->execute();

			$admin = $stmt->fetch();
			if($id == $admin['id']) {
				return false;
			}

			$stmt = $this->dbh->prepare("DELETE FROM user WHERE id = :id");

			return $stmt->execute(array(
				':id' => $id
				));

		}

		public function fetchUserNames(){
			$stmt = $this->dbh->prepare("SELECT id, username FROM user WHERE role='admin'");
			$stmt->execute();

			return $stmt->fetchAll();
		}

	}