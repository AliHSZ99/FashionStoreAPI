<?php

require(dirname(__DIR__)."\\model\\Client.php");

include "\\xampp\\htdocs\\vendorJWT\\autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Clients {

    public function addClient() {
        $theRequest = file_get_contents("php://input");
        $theRequest = json_decode($theRequest, true);
        header("content-type: application/json");
        print_r($theRequest);

        $client = new webservice\model\Client();
        $client->api_key = $theRequest["apikey"];
        $client->token = "";
        $client->insertClient();
    }
}