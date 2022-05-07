<?php
include_once(dirname(__DIR__)."\\core\\Model.php");
include_once(dirname(__DIR__)."\\model\\OrderItems.php");
include_once(dirname(__DIR__)."\\model\\Client.php");
include_once(dirname(__DIR__)."\\model\\Checkout.php");
require_once(dirname(__DIR__)."\\model\\Item.php");


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
            $logger = new Logger('my_logger');
            // Now add some handlers
            $logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());

            $info = file_get_contents("php://input");
            $info = json_decode($info, true);
            $client = new \webservice\model\Client();
            $email = $info["email"];
            $client = $client->getClientByEmail($email);

            $headers = apache_request_headers();
            // var_dump($headers);

            $authorizationHeader = $headers["Authorization"];
            $authorizationParts = explode(" ", $authorizationHeader);
            $key = "ali";
            $jwt = $authorizationParts[1];
            header("Content-Type: application/json");
            try {
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            } catch (Exception $e) {
                return "Invalid token";
                $logger->error("\nInvalid Token was used to add an item to the cart");
            }

            
            $item = new \webservice\model\OrderItems();
            //$info
            if ($item->isItemExist($client->client_id, $info["item_id"])) {
               return "Item already exists in the cart";
            } else {
                $item->quantity = 1;
                $item->size = $info["size"];
                $item->addToCart($client->client_id, $info["item_id"]);
                return "Item has been added to your cart";
            }
        }

        public function removeFromCart() {
            // Create the logger
            $logger = new Logger('my_logger');
            // Now add some handlers
            $logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());

            $info = file_get_contents("php://input");
            $info = json_decode($info, true);
            $client = new \webservice\model\Client();
            $email = $info["email"];
            $client = $client->getClientByEmail($email);

            $headers = apache_request_headers();
            // var_dump($headers);

            $authorizationHeader = $headers["Authorization"];
            $authorizationParts = explode(" ", $authorizationHeader);
            $key = "ali";
            $jwt = $authorizationParts[1];
            try {
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            } catch (Exception $e) {
                return "Invalid token";
                $logger->error("\nInvalid Token was used to delete an item from the cart");
            }
            
            $item = new \webservice\model\OrderItems();
            //$info
            $item->size = $info["size"];
            $item->removeFromCart($client->client_id, $info["item_id"]);
            $logger->info("\nItem has been removed from cart");
            return "Item has been removed from your cart";
        }

        public function removeAllFromCart() {
            // Create the logger
            $logger = new Logger('my_logger');
            // Now add some handlers
            $logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());

            $info = file_get_contents("php://input");
            $info = json_decode($info, true);
            $email = $info["email"];

            $headers = apache_request_headers();
            // var_dump($headers);

            $authorizationHeader = $headers["Authorization"];
            $authorizationParts = explode(" ", $authorizationHeader);
            $key = "ali";
            $jwt = $authorizationParts[1];
            header('content-type: application/json');
            try {
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            } catch (Exception $e) {
                return "Invalid token";
                $logger->error("\nInvalid Token was used for checkout");
            }

            $logger->info("\nRemoved all items from the client's cart");

            $client = new \webservice\model\Client();
            $client = $client->getClientByEmail($email);
            
            $item = new \webservice\model\OrderItems();
            //$info
            $items = new webservice\model\Checkout();
            // $items = $items->getAllItems($client->client_id);
            // $items = json_encode($items);
            if (!$items->isItemsExist($client->client_id)) {
                return "noitems";
            } else {
                $item->removeAllFromCart($client->client_id);
            }
        }

        // To display all client items in cart
        public function getAllItems() {
            // Create the logger
            $logger = new Logger('my_logger');
            // Now add some handlers
            $logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());

            $logger->info("\nGetting all items in cart");

            $info = file_get_contents("php://input");
            $info = json_decode($info, true);
            $email = $info["email"];
    
            $headers = apache_request_headers();
            // var_dump($headers);

            $authorizationHeader = $headers["Authorization"];
            $authorizationParts = explode(" ", $authorizationHeader);
            $key = "ali";
            $jwt = $authorizationParts[1];
            try {
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            } catch (Exception $e) {
                return "Invalid token";
                $logger->error("\nInvalid Token was used to access cart");
            }

            $logger->info("\nThe data for the cart has been retrieved and is ready to be sent to the client");

            header('content-type: application/json');
    
            $client = new webservice\model\Client();
            $client = $client->getClientByEmail($email);
            $items = new webservice\model\OrderItems();
            $items = $items->getItems($client->client_id);
            $itemObject = new webservice\model\Item();
            $itemsPayload = array();
            foreach ($items as $item) {
                $itemObject = $itemObject->get($item->item_id);
                $addArray = array();
                $addArray['item_id'] = strval($itemObject->item_id);
                $addArray["item_name"] = strval($itemObject->item_name);
                $addArray["item_price"] = strval($itemObject->item_id);
                $addArray["item_type"] = strval($itemObject->item_brand);
                $addArray["item_brand"] = strval($itemObject->item_color);
                $addArray["item_price"] = strval($itemObject->item_price);
                $itemsPayload[] = $addArray;
            }
            // var_dump($itemsPayload);
            $itemsPayload = json_encode($itemsPayload);
            return $itemsPayload;
        }

    }

