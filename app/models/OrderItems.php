<?php
namespace app\models;

class Orderitems extends \app\core\Model{
    public $guest_id;
	public $item_id;
	public $quantity;
	public $size;

	public function __construct(){
		parent::__construct();
	}

    //function that get the current item 
    public function getItem($guest_id,$item_id) {
        $SQL = 'SELECT * FROM orderitems WHERE guest_id = :guest_id AND item_id = :item_id';
        $STMT = self::$_connection->query($SQL);
        $STMT->execute(['guest_id' => $guest_id, 'item_id' => $item_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orderitems');
        return $STMT->fetch();//return the item
    }

	public function addToCart($guest_id, $item_id) {
        $SQL = 'INSERT INTO orderitems($guest_id, item_id, quantity, size) VALUES (:guest_id, :item_id, :quantity, :size)';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['guest_id'=>$guest_id, 'item_id'=>$item_id, 'quantity'=>$this->quantity, 'size'=>$this->size]);
    }

    // method that checks if the item is already in the cart. 
    public function isItemExist($guest_id, $item_id) {
        $SQL = "SELECT COUNT(*) FROM orderItems WHERE guest_id = :guest_id AND item_id = :item_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['guest_id' => $guest_id, 'item_id' => $item_id]);
        $count = $STMT->fetch();

        if ($count["COUNT(*)"] >= 1) {
            return true;
        }

        return false;
    }

    // method that updates the quantity of the item in the cart.
    public function updateQuantity($guest_id, $item_id, $quantity) {
        $SQL = "UPDATE orderItems SET quantity = :quantity WHERE guest_id = :guest_id AND item_id = :item_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['guest_id' => $guest_id, 'item_id' => $item_id, 'quantity' => $quantity]);
    }
}