<?php

namespace app\models;

class OrderItems extends \app\core\Model {
	
	public $order_id;
	public $item_id;
	public $quantity;

	public function __construct(){
		parent::__construct();
	}

}