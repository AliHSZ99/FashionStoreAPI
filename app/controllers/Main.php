<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";

class Main extends \app\core\Controller {

	public function index()
	{
		$this->view('Main/index');
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
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		/*
		The type of data we would send is: item info, apikey.. we could make cart a part of the api
		*/
		// $data = json_encode(array("clientID"=>"1", "requestDate"=>"12/14/21", "requestCompletionDate"=>"12/14/21",
	 	// "originalFormat"=> ".mp4", "targetFormat"=> ".avi", "inputFile"=> "C:\\xampp\htdocs\\testvideo.mp4" , "APIKey"=> "1234" ));
		$requestOne = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json']];
		//$requestTwo = ['body' => $data, 'headers' => ['accept' => 'application/json']];
		//GET
		$response = $client->request('GET', 'item/1', $requestOne);
		//POST
		//$response = $client->request('POST', 'video/convert', $requestTwo);
		//remove this if you want to work on about.
		var_dump($response);
	
	$contents = $response->getBody()->getContents();
	echo $contents;
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
				$this->view("Main/login");
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
				$_SESSION['user_id'] = $guest->guest_id;
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


	public function logout(){
		//destroy session variables
		session_destroy();
		header('location:/Main/login');
	}

}