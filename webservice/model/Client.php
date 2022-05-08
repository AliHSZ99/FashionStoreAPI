<?php

namespace webservice\model;

// require(dirname(__DIR__)."\\core\\Model.php");

// Class Client. 
class Client extends \webservice\core\Model {

    public $client_id;
    public $api_key;
    public $email;

    // Insert a client. 
    public function insertClient(){
      $SQL = 'INSERT INTO client(api_key, email) VALUES (:api_key, :email)';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['api_key' => $this->api_key, "email" => $this->email]);
	  }

    // Get a specific client. 
    public function get($clientID) {
      $SQL = 'SELECT * FROM client WHERE clientID = :clientID';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['clientID' => $clientID]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Client');
      return $STMT->fetch();
    }

    // Get a client using the API key. 
    public function getClientByAPIKey() {
      $SQL = "SELECT * FROM client WHERE api_key = :api_key";
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['api_key' => $this->api_key]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Client');
      return $STMT->fetch();
    }

    // Get a client based on their email address. 
    public function getClientByEmail($email) {
      $SQL = "SELECT * FROM client WHERE email = :email";
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['email' => $email]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Client');
      return $STMT->fetch();
    }

    // Add a token to a client. 
    public function addToken() {
      $SQL = "UPDATE client SET token = :token WHERE api_key = :api_key";
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['token' => $this->token, 'api_key' => $this->api_key]);
    }

}

