<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";

class Main extends \app\core\Controller {
	
	public function index()
	{
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		$tokenWithBearer = "";
		if ($guest->token == "") {
			// echo "hello";
			$POST = ["guest_id" => $_SESSION["guest_id"], "apikey" => $guest->api_key];
			$POST = json_encode($POST);
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json'], 
				"body" => $POST
			];

			$response = $client->request("POST", "auth/index", $request);
			print_r($response);

			// $body = $response->getBody()->getContents();
			// $arr_body = json_decode($body, true);
			// print_r($arr_body);

			// $headers = $response->getHeaders();
			// print_r($headers);

			$tokenWithBearer = $response->getHeader('WWWW-Authenticate')[0];
			$splitToken = explode(" ", $tokenWithBearer);
			// echo "<br>";
			// print_r($tokenWithBearer);
			$token = $splitToken[1];
			$guest->token = $token;
			$guest->addToken();
		}

		$tokenWithBearer = "Bearer ".$guest->token;
		$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => $tokenWithBearer]];
		// echo "<br><br><br>". $tokenWithBearer;
		$response = $client->request('GET', 'item/getAll', $request);
		$contents = $response->getBody()->getContents();
		$contents = json_decode($contents);
		if (!is_array($contents)) {
			header("location: /ErrorPages/error401");
		}

		$this->view('Main/index', $contents);
	}

	public function insert()
	{
		if(isset($_POST['action'])) 
		{
			//redirect the user back to the index
			header('location:/Main/index');

		} else //1 present a form to the user
			$this->view('Main/addAnimal');
	}

	public function about() 
	{
		$this->view('Main/about');
		// $client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		// /*
		// The type of data we would send is: item info, apikey.. we could make cart a part of the api
		// */
		// // $data = json_encode(array("clientID"=>"1", "requestDate"=>"12/14/21", "requestCompletionDate"=>"12/14/21",
	 	// // "originalFormat"=> ".mp4", "targetFormat"=> ".avi", "inputFile"=> "C:\\xampp\htdocs\\testvideo.mp4" , "APIKey"=> "1234" ));
		//$requestOne = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json']];
		// //$requestTwo = ['body' => $data, 'headers' => ['accept' => 'application/json']];
		// //GET
		// $response = $client->request('GET', 'item/1', $requestOne);
		// //POST
		// //$response = $client->request('POST', 'video/convert', $requestTwo);
		// //remove this if you want to work on about.
		// var_dump($response);
		// $response = $client->request('GET', 'item/populate', $requestOne);
		// $contents = $response->getBody()->getContents();
		// echo $contents;
	//$decoded = json_decode($contents); 
	//echo $decoded->licenseNumber;
	}

	public function cart() {
		$this->view('Main/cart');
	}

	public function delete($animal_id){//delete a record with the known animal_id PK value
		// $animal = new \app\models\Animal;
		// $animal->delete($animal_id);
		header('location:/Main/index');
	}

	public function edit($animal_id){//edit a record for te record with known animal_id PK
		// $animal = new \app\models\Animal;
		// $animal = $animal->get($animal_id);

		if(isset($_POST['action'])){//am i submitting the form?
			//handle the input overwriting the existing properties
			//redirect after changes
			header('location:/Main/index');
		}else
			// $this->view('Main/edit',$animal);
			echo "hello";
	}

	public function details($animal_id){
		// $this->view('Main/details',$animal);
	}

	public function generateApiKey() {
		return "fashionstore". uniqid();
	}

	public function register(){

		if (isset($_POST['action'])) {//verify that the user clicked the submit button
			$guest = new \app\models\Guest();
			$guest->email = $_POST['email'];

			if ($guest->emailExists() > 0) {
				$this->view('Main/register', 'The Email already exists...');
				return;
			}

			$guest->first_name = $_POST['first'];
			$guest->last_name = $_POST['last'];
			$guest->phone_number = $_POST['phone'];
			$password = $_POST['password'];
			$passwordConfirm = $_POST['password_confirm'];

			if ($password == $passwordConfirm) {
				$guest->password = $password;
				$guest->api_key = $this->generateApiKey();
				$guest->insertGuest();

				$guest = $guest->getGuestByEmail($_POST['email']);
				// make a POST request to save API key to the webservice
				$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
				$POST = ["guest_id" => $guest->guest_id, "apikey" => $guest->api_key];
				$POST = json_encode($POST);
				$request = [
					"headers" => ['accept' => 'application/json', 'content-type' => 'application/json'], 
					"body" => $POST
				];
				$response = $client->request("POST", "clients/addClient", $request);
				$body = $response->getBody()->getContents();
				// echo $body;
				// print_r($body);

				header('location:/Main/login');
			} else {
				$this->view("Main/register", "Passwords do not match...");
				return;
			}
		} else {
			$this->view('Main/register');
		}
	}

	
	public function login(){
		if (isset($_POST['action'])) {
			$guest = new \app\models\Guest();
			$guest = $guest->getGuestByEmail($_POST['email']);

			if ($guest != false && password_verify($_POST['password'], $guest->password_hash)) {
				$_SESSION['guest_id'] = $guest->guest_id;
				$_SESSION['email'] = $guest->email;
				header('location:/Main/index');
			} else {
				$this->view('Main/login', 'Wrong username and password combination!');
				return;
			}
		} else {
			$this->view('Main/login');
		}
	}

	public function settings()
	{
		if (isset($_POST["action"])) {
			header("location:/Main/logout");
		}

		if (isset($_POST["newPasswordClicked"])) {
			$guest = new \app\models\Guest();
			$guest->password = $_POST["password"];
			$guest->updatePassword($_SESSION["guest_id"]);

			$this->view("Main/settings", "password updated!");
			return;
		}


		$this->view('Main/settings');
	}
	public function logout(){
		//destroy session variables
		session_destroy();
		header('location:/Main/login');
	}

	// This method is for testing purpsoses only
	public function quickShopButton(){
		$this->view('Main/item');
	}

}