<?php

namespace app\controllers;

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends \app\core\Controller {

    // function that will check if the client is valid in order to generate a token
    public function index() {
        $theRequest = file_get_contents("php://input");
		$theRequest = json_decode($theRequest);
		header("content-type: application/json");

        $guest = new \app\models\Guest();
        $guest->apikey = $theRequest->apikey;

        
        $client = $->getClientByAPIKey();

        // Checking if client exists
        if ($client == null) {
            echo "<br>The client does not exist";
            header("WWW-Authenticate: Error... Client does not exist");
            return;
        }

        // test purposes
        // echo "hello";

        // If the client exist, we now check if the license is still valid. 
        if ($client->licenseEndDate >= date("Y-m-d")) {
            $key = "ali";
            $payload = array(
                "iss" => "http://localhost/Auth/index",
                "iat" => time(),
                "exp" => time() + 2.628e+6 
            );
            
            // generate token
            $jwt = JWT::encode($payload, $key, 'HS256');
            
            // headers of the response. 
            header("WWW-Authenticate: Bearer $jwt");
            header("content-type: application/json");
        } else {            
            header("content-type: application/json");
            header("WWW-Authenticate: Error... Your license expired");
        }


    }
}