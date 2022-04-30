<?php

namespace app\models;

class Guest extends \app\core\Model {
	
	public $guest_id;
	public $email;
	public $first_name;
	public $last_name;
	public $password;
	public $password_hash;
	public $phone_number;
	public $api_key;
	public $token;

	public function __construct(){
		parent::__construct();
	}

	// public function get($username){
	// 	$SQL = 'SELECT * FROM user WHERE username LIKE :username';
	// 	$STMT = self::$_connection->prepare($SQL);
	// 	$STMT->execute(['username'=>$username]);
	// 	$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\User');
	// 	return $STMT->fetch();//return the record
	// }

	public function insertGuest(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO guest(email, first_name, last_name, password_hash, phone_number, api_key) VALUES (:email, :first_name, :last_name, :password_hash, :phone_number, :api_key)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name,
					'password_hash' => $this->password_hash, 'phone_number' => $this->phone_number, 'api_key' => $this->api_key]);
	}

	public function addToken() {
		$SQL = 'UPDATE guest SET token = :token WHERE guest_id = :guest_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['token' => $this->token, 'guest_id' => $this->guest_id]);
	}

	public function emailExists() {
		$SQL = 'SELECT COUNT(email) FROM guest WHERE email = :email';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['email' => $this->email]);
		// $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Guest');
		return $STMT->fetch()["0"];
	}

	public function getGuestByEmail($email) {
		$SQl = 'SELECT * FROM guest WHERE email = :email';
		$STMT = self::$_connection->prepare($SQl);
		$STMT->execute(['email' => $email]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Guest');
		return $STMT->fetch();
	}

/*	public function update(){//update an user record
		$SQL = 'UPDATE `user` SET `species`=:species,`colour`=:colour WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['species'=>$this->species,'colour'=>$this->colour,'user_id'=>$this->user_id]);//associative array with key => value pairs
	}

	public function delete($user_id){//update an user record
		$SQL = 'DELETE FROM `user` WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);//associative array with key => value pairs
	}*/

	public function updatePassword($id) {
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = "UPDATE guest SET password_hash = :password_hash WHERE guest_id = :guest_id"; 
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(["password_hash" => $this->password_hash, "guest_id" => $id]);
	}

}