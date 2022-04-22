<?php
namespace app\controllers;

require_once('C:\\xampp\\htdocs\\vendor\\autoload.php');

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
		$data = json_encode(array("clientID"=>"1", "requestDate"=>"12/14/21", "requestCompletionDate"=>"12/14/21",
	 	"originalFormat"=> ".mp4", "targetFormat"=> ".avi", "inputFile"=> "C:\\xampp\htdocs\\testvideo.mp4" , "APIKey"=> "1234" ));
		$requestOne = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json']];
		//$requestTwo = ['body' => $data, 'headers' => ['accept' => 'application/json']];
		//GET
		$response = $client->request('GET', 'item/1', $requestOne);
		//POST
		//$response = $client->request('POST', 'video/convert', $requestTwo);
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


	public function register(){

		if(isset($_POST['action']) && $_POST['password'] == $_POST['password_confirm']){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user->username = $_POST['username'];
			$user->password = $_POST['password'];
			$user->insert();//password hashing done here
			//redirect the user back to the index
			header('location:/Main/login');

		}else //1 present a form to the user
			$this->view('Main/register');
	}

	
	public function login(){
		//TODO: register session variables to stay logged in
		if(isset($_POST['action'])){//verify that the user clicked the submit button
			$user = new \app\models\User();
			$user = $user->get($_POST['username']);

			if($user!=false && password_verify($_POST['password'], $user->password_hash)){
				$_SESSION['user_id'] = $user->user_id;
				$_SESSION['username'] = $user->username;
				header('location:/Secure/index');
			}else{
				$this->view('Main/login','Wrong username and password combination!');
			}

		}else //1 present a form to the user
			$this->view('Main/login');
	}


	public function logout(){
		//destroy session variables
		session_destroy();
		header('location:/Main/login');
	}

}