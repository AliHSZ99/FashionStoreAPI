<?php

namespace webservice\models;

require(dirname(__DIR__)."\\core\\Model.php");

class Client extends \webservice\core\Model {

    public $clientID;
    public $clientName;
    public $licenseNumber;
    public $licenseStartDate;
    public $licenseEndDate;
    public $APIKey;

    public function insert(){
		$SQL = 'INSERT INTO client(clientName, licenseNumber, licenseStartDate, licenseEndDate, APIKey) 
            VALUES (:clientName, :licenseNumber, :licenseStartDate, :licenseEndDate, :APIKey)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['clientName'=>$this->clientName, 'licenseNumber'=>$this->licenseNumber, 'licenseStartDate'=>$this->licenseStartDate,
        'licenseEndDate'=>$this->licenseEndDate, 'APIKey'=>$this->APIKey]);
	  }

    public function get($clientID) {
      $SQL = 'SELECT * FROM client WHERE clientID = :clientID';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['clientID' => $clientID]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\models\\Client');
      return $STMT->fetch();
    }

}

