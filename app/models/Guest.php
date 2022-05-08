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

	// A method that inserts a guest on the guest table
	public function insertGuest(){
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = 'INSERT INTO guest(email, first_name, last_name, password_hash, phone_number, api_key) VALUES (:email, :first_name, :last_name, :password_hash, :phone_number, :api_key)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name,
					'password_hash' => $this->password_hash, 'phone_number' => $this->phone_number, 'api_key' => $this->api_key]);
	}

	// A method that adds a token to a specific guest
	public function addToken() {
		$SQL = 'UPDATE guest SET token = :token WHERE guest_id = :guest_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['token' => $this->token, 'guest_id' => $this->guest_id]);
	}

	// A method that checks if an email exist in the guest table
	public function emailExists() {
		$SQL = 'SELECT COUNT(email) FROM guest WHERE email = :email';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['email' => $this->email]);
		// $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Guest');
		return $STMT->fetch()["0"];
	}

	// A method that gets a specific guest based on their email
	public function getGuestByEmail($email) {
		$SQl = 'SELECT * FROM guest WHERE email = :email';
		$STMT = self::$_connection->prepare($SQl);
		$STMT->execute(['email' => $email]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Guest');
		return $STMT->fetch();
	}

	// A method that gets a specific guest based on their guest id
	public function getGuest($id) {
		$SQL = 'SELECT * FROM guest WHERE guest_id = :guest_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['guest_id' => $id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Guest');
		return $STMT->fetch();
	}

	// A method that updates a password of a specific guest 
	public function updatePassword($id) {
		$this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
		$SQL = "UPDATE guest SET password_hash = :password_hash WHERE guest_id = :guest_id"; 
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(["password_hash" => $this->password_hash, "guest_id" => $id]);
	}

}