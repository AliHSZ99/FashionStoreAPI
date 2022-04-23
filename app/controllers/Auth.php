<?php

include "\\xampp\\htdocs\\app\\vendorJWT\\autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends \app\core\Controller {
    
    public function index()
    {
        $theRequest = file_get_contents("php://input");
		$theRequest = json_decode($theRequest);
		header("content-type: application/json");
    }

}
?>