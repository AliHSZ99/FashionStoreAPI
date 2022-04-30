<?php

namespace webservice\model;

require(dirname(__DIR__)."\\core\\Model.php");

class Item extends \webservice\core\Model {

    public $item_id;
    public $item_name;
    public $item_type;
    public $item_brand;
    public $item_color;
    public $item_price;
    public $image_url;

    public function insert(){
		$SQL = 'INSERT INTO item(clientName, licenseNumber, licenseStartDate, licenseEndDate, APIKey) 
            VALUES (:clientName, :licenseNumber, :licenseStartDate, :licenseEndDate, :APIKey)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['clientName'=>$this->clientName, 'licenseNumber'=>$this->licenseNumber, 'licenseStartDate'=>$this->licenseStartDate,
        'licenseEndDate'=>$this->licenseEndDate, 'APIKey'=>$this->APIKey]);
	  }

    public function get($item_id) {
      $SQL = 'SELECT * FROM item WHERE item_id = :item_id';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['item_id' => $item_id]);
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Item');
      return $STMT->fetch();
    }

    public function getItems() {
      $SQl = 'SELECT * FROM item';
      $STMT = self::$_connection->prepare($SQl);
      $STMT->execute();
      $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Item');
      return $STMT->fetchAll();
    }

}