<?php
require(dirname(__DIR__)."\\core\\Model.php");
require_once(dirname(__DIR__)."\\model\\OrderItems.php");
require_once(dirname(__DIR__)."\\model\\Client.php");


include "\\xampp\\htdocs\\vendorJWT\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
    class cart {

        public function addToCart() {
            // Create the logger
            $info = file_get_contents("php://input");
            $info = json_decode($info, true);
            $client = new \webservice\model\Client();
            $client->api_key = $info["api_key"];
            $client = $client->getClientByAPIKey();
            
            $item = new \webservice\model\OrderItems();
            //$info
            if ($item->isItemExist($client->client_id, $info["item_id"])) {
                $currentItem = $item->getItem($client->client_id, $info["item_id"]);
                $currentItem->updateItem($client->client_id, $info["item_id"], $currentItem->quantity + 1);
            } else {
                $item->quantity = 1;
                $item->size = $info["size"];
                $item->addToCart($client->client_id, $info["item_id"]);
                return "Item has been added to your cart";
            }
        }
    }

