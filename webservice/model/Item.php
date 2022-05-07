<?php

namespace webservice\model;

require_once(dirname(__DIR__)."\\core\\Model.php");

class Item extends \webservice\core\Model {

    public $item_id;
    public $item_name;
    public $item_type;
    public $item_brand;
    public $item_color;
    public $item_price;
    public $image_url;

    public function insertItem(){
      $SQL = 'INSERT INTO item(item_name, item_type, item_brand, item_color, item_price, image_url) VALUES 
      (:item_name, :item_type, :item_brand, :item_color, :item_price, :image_url)';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['item_name' => $this->item_name, 'item_type' => $this->item_type, 'item_brand' => $this->item_brand,
            'item_color' => $this->item_color, 'item_price' => $this->item_price, 'image_url' => $this->image_url]);
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