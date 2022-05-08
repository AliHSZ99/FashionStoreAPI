<?php
namespace webservice\model;

// require(dirname(__DIR__)."\\core\\Model.php");

// Class OrderItems.
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

    // Get items for a specific client.
    public function getItems($guest_id) {
        $SQL = 'SELECT * FROM checkout WHERE client_id = :client_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id' => $guest_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS,'webservice\\model\\Orderitems');
        return $STMT->fetchAll();//return the item
    }

    // Add item to cart. 
	public function addToCart($guest_id, $item_id) {
        $SQL = 'INSERT INTO checkout(client_id, item_id, size) VALUES (:client_id, :item_id, :size)';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id'=>$guest_id, 'item_id'=>$item_id, 'size'=>$this->size]);
    }

    // Remove from cart. 
    public function removeFromCart($guest_id, $item_id) {
        $SQL = 'DELETE FROM checkout WHERE client_id = :client_id AND item_id = :item_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id'=>$guest_id, 'item_id'=>$item_id]);
    }

    // Remove everything from the cart. 
    public function removeAllFromCart($guest_id) {
        $SQL = 'DELETE FROM checkout WHERE client_id = :client_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id'=>$guest_id]);
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

}