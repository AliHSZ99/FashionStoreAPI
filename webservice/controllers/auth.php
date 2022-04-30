<?php

require(dirname(__DIR__)."\\model\\Client.php");

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth {

    // function that will check if the client is valid in order to generate a token
    public function index() {
        // Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/webservice/webservice.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

        $theRequest = file_get_contents("php://input");
		$theRequest = json_decode($theRequest);

        $client = new \webservice\model\Client();
        $client->api_key = $theRequest->apikey;
        
        $client = $client->getClientByAPIKey();

        // Checking if client exists
        if ($client == null) {
            echo "<br>The client does not exist";
            $logger->error("\nA client tried to access the webservice and does not exist");
            header("WWWW-Authenticate: Error... Client does not exist");
            return;
        }

        // test purposes
        // echo "hello";

        // If the client exist, we now check if the license is still valid. 
        $key = "ali";
        $payload = array(
            "iss" => "http://localhost/Auth/index",
            "iat" => time(),
            "exp" => time() + 2.628e+6 
        );
        $logger->info("\nA token has been generated for client with API key: " . $theRequest->apikey);
        
        // generate token
        $jwt = JWT::encode($payload, $key, 'HS256');

        
        // headers of the response. 
        header("WWWW-Authenticate: Bearer $jwt");
        header("content-type: application/json");

    }
}