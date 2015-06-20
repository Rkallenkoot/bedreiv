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

	public function insertUser($username, $passwordhash, $role){
		$stmt = $this->dbh->prepare("INSERT INTO user (username, password, role)
				VALUES (:username, :password, :role)");

		// Returns true when inserted succesfully
		return $stmt->execute(array(
			'username' => $username,
			'password' => $passwordhash,
			'role' => $role
			));
	}

    public function fetchUserNames(){
        $stmt = $this->dbh->prepare("SELECT id, username FROM user WHERE role='admin'");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}