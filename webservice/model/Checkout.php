<?php
namespace webservice\model;

// Checkout model. 
class Checkout extends \webservice\core\Model {
    public $client_id;
	public $item_id;
	public $size;

    public function __construct(){
		parent::__construct();
	}

    // Get all items from checkout for a specific client. 
    public function getAllItems($client_id) {
        $SQL = 'SELECT * FROM checkout WHERE client_id = :client_id';
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id' => $this->client_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'webservice\\model\\Checkout');
        return $STMT->fetchAll();
    }

    // Method to check if the item exists. 
    public function isItemsExist($guest_id) {
        $SQL = "SELECT COUNT(*) FROM checkout WHERE client_id = :client_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(['client_id' => $guest_id]);
        $count = $STMT->fetch();

        if ($count["COUNT(*)"] >= 1) {
            return true;
        }

        return false;
    }
    
}