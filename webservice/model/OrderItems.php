<?php
namespace webservice\model;

// require(dirname(__DIR__)."\\core\\Model.php");

class Orderitems extends \webservice\core\Model{
    public $guest_id;
	public $item_id;
	public $size;

	public function __construct(){
		parent::__construct();
	}

    //function that get the current item 
    public function getItem($guest_id,$item_id) {
        $SQL = 'SELECT * FROM checkout WHERE client_id = :client_id AND item_id = :item_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\Orderitems');
        return $STMT->fetch();//return the item
    }

	public function addToCart($guest_id, $item_id) {
        $SQL = 'INSERT INTO checkout(client_id, item_id, quantity, size) VALUES (:client_id, :item_id, :quantity, :size)';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id'=>$guest_id, 'item_id'=>$item_id, 'quantity'=>$this->quantity, 'size'=>$this->size]);
    }

    // method that checks if the item is already in the cart. 
    public function isItemExist($guest_id, $item_id) {
        $SQL = "SELECT COUNT(*) FROM checkout WHERE client_id = :client_id AND item_id = :item_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id' => $guest_id, 'item_id' => $item_id]);
        $count = $STMT->fetch();

        if ($count["COUNT(*)"] >= 1) {
            return true;
        }

        return false;
    }

    // method that updates the quantity of the item in the cart.
    public function updateQuantity($guest_id, $item_id) {
        $SQL = "UPDATE checkout SET quantity = :quantity WHERE guest_id = :guest_id AND item_id = :item_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['guest_id' => $guest_id, 'item_id' => $item_id, 'quantity' => $this->$quantity+1]);
    }
}