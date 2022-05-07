<?php

include(dirname(__DIR__)."\\core\\Model.php");
require(dirname(__DIR__)."\\model\\Client.php");
require(dirname(__DIR__)."\\model\\OrderItems.php");
require_once(dirname(__DIR__)."\\model\\Item.php");

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Checkout {

    public function checkout() {
        // // Create the logger    
        // $info = file_get_contents("php://input");
        // $info = json_decode($info, true);
        // $client = new webservice\model\Client();
        // $client = $client->getClientByEmail($info["email"]);


        // $logger = new Logger('my_logger');
        // // Now add some handlers
        // $logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
        // $logger->pushHandler(new FirePHPHandler());

        // $headers = apache_request_headers();
        // // var_dump($headers);
    
        // $authorizationHeader = $headers["Authorization"];
        // $authorizationParts = explode(" ", $authorizationHeader);
        // $key = "ali";
        // $jwt = $authorizationParts[1];

        // try {
        //     $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        // } catch (Exception $e) {
        //     echo "Invalid Token";
        //     $logger->error("\nInvalid Token was used");
        // }
        
        // $logger->info("\nCheckout items are being retrieved");

        // header('content-type: application/json');
        // $items = new webservice\model\Checkout();
        // $items = $items->getAllItems($client->client_id);
        // foreach ($items as $item) {
        //     $addArray = array();
        //     $addArray["client_id"] = strval($item->client_id);
        //     $addArray["item_id"] = strval($item->item_id);
        //     $addArray["size"] = strval($item->size);
        //     $itemsPayload[] = $addArray;
        // }

        // $itemsPayload = json_encode($itemsPayload);

        // return $itemsPayload;

    }

    public function getAllItems() {
        $info = file_get_contents("php://input");
        $info = json_decode($info, true);

        $client = new webservice\model\Client();
        $client->api_key = $info['apikey'];
        $client = $client->getClientByAPIKey();

        header('content-type: application/json');

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
        $itemsPayload = json_encode($itemsPayload);
        return $itemsPayload;
    }


}