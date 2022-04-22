<?php

	require_once("request.php");

	// Create a new instance of the request and initialize it by setting its fields
	// we are using the Factory pattern to some extent
	
	class RequestBuilder{
		
		private $Request;
		
		function getRequest(){
			
			$this->Request = new Request();
			
			$this->Request->method = $_SERVER['REQUEST_METHOD'];
			
			$this->Request->header = apache_request_headers();

			$this->Request->payload = file_get_contents('php://input');

			// Here $_GET[0] will be for example 'clients' in case the URL is of the form /index.php?clients=123

			$key = array_keys($_GET)[0];

			if (isset( $_GET[$key] )) {
				
				$this->Request->urlparams = $_GET;

			}

			return $this->Request;
			
		}

	}

?>