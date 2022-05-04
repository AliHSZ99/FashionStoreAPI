<?php

	//1- Request for a video conversion will be using the URL:
	// http://localhost/webservice/api/index.php?conversion

	
	//2- Get the request information
	
	require_once(dirname(__DIR__)."\\api\\http\\requestbuilder.php");

	spl_autoload_register(
		function ($class_name) {
			if (file_exists(dirname(__DIR__).'/controllers/' . $class_name . '.php')) {
				include(dirname(__DIR__).'/controllers/'. $class_name . '.php'); 
			} else if (file_exists(dirname(__DIR__).'/model/' . $class_name . '.php')) {
				include(dirname(__DIR__).'/model/'. $class_name . '.php'); 
			}
		}
	);
	
	class API{
		
		public $Request;
	
		private $Controller;

		function __construct(){
			
			$RequestBuilder = new RequestBuilder();
			
			$this->Request = $RequestBuilder->getRequest();

			// Determine which controller to load based on the URL parameters

			//$url = parseURL();

			$keys = array_keys($this->Request->urlparams);

			if(file_exists(dirname(__DIR__).'/controllers/' .$keys[0]. '.php')){

				if(class_exists($keys[0])){

					$this->Controller = new $keys[0];

					switch ($this->Request->method){

						case 'GET':
							$this->get();
							break;
						case 'POST':
							$this->post();
							break;

						/// check for other methods

					}
				}

			}	

		}
		
		// private function get(){

		// 	switch($this->Request->header['accept']){

		// 		case 'application/json':
		// 			$responsepayload = $this->Controller->getData($_GET['clients']);
		// 			echo $responsepayload;
		// 			break;
		// 		//handle other formats
		// 	}
		// }

		private function get(){
			$accept = '';
			if (isset($this->Request->header['accept'])) {
				$accept = $this->Request->header['accept'];
			} else if (isset($this->Request->header['Accept'])) {
				$accept = $this->Request->header['Accept'];
			}

			switch($accept){
				case 'application/json':
					if ($_GET['item'] == 'getAll') {
						$responsepayload = $this->Controller->getAllData();
						echo $responsepayload;
					} else if ($_GET['item'] == 'populate'){
						$responsepayload = $this->Controller->populateItemTable();
						echo $responsepayload;
					} else {
						$responsepayload = $this->Controller->getData($_GET['item']);
						echo $responsepayload;

					}
					break;
				//handle other formats
			}

		}

		private function post(){
			$accept = '';
			if (isset($this->Request->header['accept'])) {
				$accept = $this->Request->header['accept'];
			} else if (isset($this->Request->header['Accept'])) {
				$accept = $this->Request->header['Accept'];
			}

			switch($accept){
				case 'application/json':
					if (isset($_GET["auth"])) {
						if ($_GET["auth"] == "index") {
							$responsepayload = $this->Controller->index();
							echo $responsepayload;
						}
					}
					else if (isset($_GET["clients"])) {
						if ($_GET["clients"] == "addClient") {
							$responsepayload = $this->Controller->addClient();
							echo $responsepayload;
						}
					}
					else if (isset($_GET["cart"])) {
						if ($_GET["cart"] == "addToCart") {
							$responsepayload = $this->Controller->addToCart();
							echo $responsepayload;
						}
					}
				//handle other formats
			}

		}
	// Identify the Request method: GET, POST, PUT, DELETE, OPTION, HEAD
	
	
	// Read the payload if it is a POST

	}
	
	$api = new API();

	//echo "client id= ".$api->Request->urlparams; 
	// echo "</br>Payload: ";
	// echo $api->Request->payload; 
	// echo "</br>Request: ";
	// echo $api->Request->method; 
	// echo "</br>";
	// echo "header: ";
	// print_r($api->Request->header); 
?>