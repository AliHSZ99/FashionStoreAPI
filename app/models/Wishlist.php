<?php
namespace app\models;

class Wishlist extends \app\core\Model{
	public $wishlist_id;
	public $guest_id;
	public $item_id;
	public $item_name;
	public $item_price;
	public $image_url;

	public function __construct(){
		parent::__construct();
	}

	// Get all the wishlist items of the current user
	public function getAllWishlist($guest_id) {
		$SQL = 'SELECT * FROM wishlist WHERE guest_id = :guest_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['guest_id' => $guest_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Wishlist');
		return $STMT->fetchAll();
	}

	public function deletewishlist($guest_id, $item_id) {
		$SQL = 'DELETE FROM wishlist WHERE guest_id = :guest_id AND item_id = :item_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['guest_id'=>$guest_id, 'item_id'=>$item_id]);
	}

	public function addWishlist($guest_id, $item_id) {
		$SQL = 'INSERT INTO wishlist(guest_id, item_id, item_name, item_price, image_url) VALUES (:guest_id, :item_id, :item_name, :item_price, :image_url)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['guest_id'=>$guest_id, 'item_id'=>$item_id, 'item_name'=>$this->item_name, 'item_price'=>$this->item_price, 'image_url'=>$this->image_url]);
	}

	// Check if the item is already in the wishlist
	public function isItemExist($guest_id, $item_id) {
        $SQL = "SELECT COUNT(*) FROM wishlist WHERE guest_id = :guest_id AND item_id = :item_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['guest_id' => $guest_id, 'item_id' => $item_id]);
        $count = $STMT->fetch();

        if ($count["COUNT(*)"] >= 1) {
            return true;
        }

        return false;
    }

/*	public function update(){//update an user record
		$SQL = 'UPDATE `user` SET `species`=:species,`colour`=:colour WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['species'=>$this->species,'colour'=>$this->colour,'user_id'=>$this->user_id]);//associative array with key => value pairs
	}

	public function delete($user_id){//update an user record
		$SQL = 'DELETE FROM `user` WHERE user_id = :user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id]);//associative array with key => value pairs
	}*/

}