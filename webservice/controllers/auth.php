<?php

require(dirname(__DIR__)."\\model\\Client.php");

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth {

    // function that will check if the client is valid in order to generate a token
    public function index() {
        $theRequest = file_get_contents("php://input");
		$theRequest = json_decode($theRequest);

        $client = new \webservice\model\Client();
        $client->api_key = $theRequest->apikey;

        
        $client = $client->getClientByAPIKey();

        // Checking if client exists
        if ($client == null) {
            echo "<br>The client does not exist";
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
        
        // generate token
        $jwt = JWT::encode($payload, $key, 'HS256');
        // $client->addToken($jwt);

        // $client = json_encode($client);
        // echo $client;
        
        // headers of the response. 
        header("WWWW-Authenticate: Bearer $jwt");
        header("content-type: application/json");

    }
}