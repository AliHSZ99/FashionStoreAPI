<?php
include(dirname(__DIR__)."\\core\\Model.php");
require(dirname(__DIR__)."\\model\\Client.php");

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Clients {

    public function addClient() {
        // echo "hello add client";
        // Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

        $theRequest = file_get_contents("php://input");
        $theRequest = json_decode($theRequest, true);
        header("content-type: application/json");
        // print_r($theRequest);

        $client = new webservice\model\Client();
        $client->api_key = $theRequest["apikey"];
        $client->token = "";
        $client->insertClient();

        $logger->info("\nA client has been added to the database with API key: " . $theRequest["apikey"]);
    }
}