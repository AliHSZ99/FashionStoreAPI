<?php

namespace app\models;

class Wishlist extends \app\core\Model {
	
	public $wishlist_id;
	public $guest_id;
	public $item_id;

	public function __construct(){
		parent::__construct();
	}

}