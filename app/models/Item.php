<?php

namespace app\models;

class Item extends \app\core\Model {
	
	public $item_id;
	public $item_name;
	public $item_type;
	public $item_brand;
	public $item_color;
	public $item_price;
	public $image_url;

	public function __construct() {
		parent::__construct();
	}

	public function insertItem(){
		$SQL = 'INSERT INTO item(item_name, item_type, item_brand, item_color, item_price, image_url) VALUES 
		(:item_name, :item_type, :item_brand, :item_color, :item_price, :image_url)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['item_name' => $this->item_name, 'item_type' => $this->item_type, 'item_brand' => $this->item_brand,
					'item_color' => $this->item_color, 'item_price' => $this->item_price, 'image_url' => $this->image_url]);
	}

	public function getAllItems() {
		$SQl = 'SELECT * FROM item';
		$STMT = self::$_connection->prepare($SQl);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Item');
		return $STMT->fetchAll();
	}


}