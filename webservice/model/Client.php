<?php

namespace webservice\model;

require(dirname(__DIR__)."\\core\\Model.php");

class Client extends \webservice\core\Model {

    public $clientID;
    public $api_key;
    public $token;

    public function insertClient(){
      $SQL = 'INSERT INTO client(api_key, token) VALUES (:api_key, :token)';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['api_key' => $this->api_key, 'token' => $this->token]);
	  }

    public function get($clientID) {
      $SQL = 'SELECT * FROM client WHERE clientID = :clientID';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['clientID' => $clientID]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\models\\Client');
      return $STMT->fetch();
    }

    public function getClientByAPIKey() {
      $SQL = "SELECT * FROM client WHERE api_key = :api_key";
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['api_key' => $this->api_key]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\models\\Client');
      return $STMT->fetch();
    }

    public function addToken($token) {
      $SQL = "UPDATE client SET token = :token WHERE api_key = :api_key";
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['token' => $token, 'api_key' => $this->api_key]);
    }

}

