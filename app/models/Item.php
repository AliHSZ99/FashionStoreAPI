<?php

namespace app\models;

class Item extends \app\core\Model {
	
	public $item_id;
	public $item_name;
	public $item_size;
	public $item_type;
	public $item_brand;
	public $item_color;
	public $item_price;

	public function __construct() {
		parent::__construct();
	}

}