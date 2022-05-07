<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";

include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Main extends \app\core\Controller {
	
	public function index()
	{
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		$tokenWithBearer = "";
		if ($guest->token == "") {
			$logger->info("\nUser with id $guest->guest_id and email {$_SESSION['email']} has no token and is trying to authenticate");

			$POST = ["guest_id" => $_SESSION["guest_id"], "apikey" => $guest->api_key];
			$POST = json_encode($POST);
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json'], 
				"body" => $POST
			];

			$response = $client->request("POST", "auth/index", $request);
			// THIS IS IMPORTANT FOR GUZZLE
			// print_r($response);

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

			$logger->notice("\nUser is being redirected to error page 401");
		}

		$logger->info("\nUser with id $guest->guest_id and email {$_SESSION['email']} has a token and successfully accessed the API");

		$this->view('Main/index', $contents);
	}

	public function about() 
	{
		$this->view('Main/about');
	// 	$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
	// 	/*
	// 	The type of data we would send is: item info, apikey.. we could make cart a part of the api
	// 	*/
	// 	// $data = json_encode(array("clientID"=>"1", "requestDate"=>"12/14/21", "requestCompletionDate"=>"12/14/21",
	//  	// "originalFormat"=> ".mp4", "targetFormat"=> ".avi", "inputFile"=> "C:\\xampp\htdocs\\testvideo.mp4" , "APIKey"=> "1234" ));
	// 	$requestOne = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json']];
	// 	//$requestTwo = ['body' => $data, 'headers' => ['accept' => 'application/json']];
	// 	//GET
	// 	$response = $client->request('GET', 'item/1', $requestOne);
	// 	//POST
	// 	//$response = $client->request('POST', 'video/convert', $requestTwo);
	// 	//remove this if you want to work on about.
	// 	var_dump($response);
	// 	$response = $client->request('GET', 'item/populate', $requestOne);
	// 	$contents = $response->getBody()->getContents();
	// 	echo $contents;
	// $decoded = json_decode($contents); 
	// echo $decoded->licenseNumber;
	}

	public function cart() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$request = ["headers" => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => "Bearer ".$guest->token],
			"body" => json_encode(["email" => $_SESSION["email"]])];
		if (isset($_POST["action"])) {
			header("location:/Main/checkout");
		}
		
		$response = $client->request("GET", "cart/getAllItems", $request);
		$body = $response->getBody()->getContents();
		// var_dump($body);
		$body = json_decode($body);
		if (!is_array($body)) {
			header("location: /ErrorPages/error401");

			$logger->notice("\nUser is being redirected to error page 401");
		}
		$this->view('Main/cart', $body);
	}

	public function checkout() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		// $cart->addToCart($_SESSION["guest_id"], $item_id);
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		// Creating request
		$request = ["headers" => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => "Bearer ".$guest->token],
			"body" => json_encode(["email" => $_SESSION["email"]])];

		$response = $client->request("GET", "cart/removeAllFromCart", $request);
		$body = $response->getBody()->getContents();
		// var_dump($body);
		if ($body == 'noitems') {
			header("location:/Main/cart");
		} else if ($body == "Invalid token") {
			header("location: /ErrorPages/error401");
			$logger->notice("\nUser is being redirected to error page 401");
		} else {
		$body = json_decode($body);
		$this->view('Main/checkout');
		}
	}

	public function generateApiKey() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		$logger->info("\nAn API key has been generated");

		return "fashionstore". uniqid();

	}

	public function register(){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

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

				// log that a user registered
				$logger->info("\nA user just registered to the website");

				$guest = $guest->getGuestByEmail($_POST['email']);
				// make a POST request to save API key to the webservice
				$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
				$POST = ["guest_id" => $guest->guest_id, "apikey" => $guest->api_key, "email" => $guest->email];
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
				return;
			} else {
				$this->view("Main/register", "Passwords do not match...");
				return;
			}
		} else {
			$this->view('Main/register');
		}
	}

	
	public function login(){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		if (isset($_POST['action'])) {
			$guest = new \app\models\Guest();
			$guest = $guest->getGuestByEmail($_POST['email']);

			if ($guest != false && password_verify($_POST['password'], $guest->password_hash)) {
				$_SESSION['guest_id'] = $guest->guest_id;
				$_SESSION['email'] = $guest->email;
				$logger->info($_SESSION["email"]);
				$logger->info("\nUser with id $guest->guest_id and email {$_SESSION['email']} logged in");

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
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());


		if (isset($_POST["action"])) {
			header("location:/Main/logout");
		}

		if (isset($_POST["newPasswordClicked"])) {
			$guest = new \app\models\Guest();
			$guest->password = $_POST["password"];
			$guest->updatePassword($_SESSION["guest_id"]);

			$logger->info("\nUser with id {$_SESSION['guest_id']} changed their password");

			$this->view("Main/settings", "password updated!");
			return;
		}

		$this->view('Main/settings');
	}
	public function logout(){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		$logger->info("\nUser with id {$_SESSION['guest_id']} and email {$_SESSION['email']} logged out and their session was destroyed");

		//destroy session variables
		session_destroy();

		header('location:/Main/login');
	}

	// This method is for testing purpsoses only
	public function quickShopButton($item_id){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token]];
		// echo "<br><br><br>". $tokenWithBearer;
		$response = $client->request('GET', "item/$item_id", $request);
		$contents = $response->getBody()->getContents();
		if ($contents == "Invalid token") {
			header("location: /ErrorPages/error401");
			$logger->notice("\nUser is being redirected to error page 401");
		}
		$contents = json_decode($contents);

		$this->view('Main/item', $contents);
	}

	// This is for wishlist 
	public function wishlist() {
		// Uncommemt this to retrieve all the records from the DB
		// $wishlist = new \app\models\Wishlist();
		// $wishlists = $wishlist->getAllWishlists($_SESSION["guest_id"]);

		$this->view('Main/wishlist');
		// Uncomment line 117 then remove line 115
		// $this->view('Main/wishlist',$wishlists);

	}

	// This method is to remove an item from the wishlist
	public function removeWishlist($item_id) {
		$wishlist = new \app\models\Wishlist();
		$wishlist->deleteWishlist($_SESSION["guest_id"], $item_id);

		$this->view('Main/wishlist');
	}

	public function removeFromCart($item_id) {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		// $cart->addToCart($_SESSION["guest_id"], $item_id);
			$guest = new \app\models\Guest();
			$guest = $guest->getGuestByEmail($_SESSION["email"]);
			$POST = ["item_id" => $item_id, "email" => $_SESSION["email"]];
			$POST = json_encode($POST);
			//WE ALWAYS TO ADD THE AUTHORIZATION HEADER IN HERE TO VERIFY TOKEN IN THE BACKEND!
			//DO THIS WHEN WE FIX TOKEN OK
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token],
				"body" => $POST
			];

			$response = $client->request("POST", "cart/removeFromCart", $request);
			$contents = $response->getBody()->getContents();
			// var_dump($contents);
			if ($contents == "Invalid token") {
				header("location: /ErrorPages/error401");
				$logger->notice("\nUser is being redirected to error page 401");
			} else {
				header('location:/Main/Cart');
			}
	}

	// This method is to add an item cart or add item on their wish list
	public function addToCart($item_id) {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		// $cart->addToCart($_SESSION["guest_id"], $item_id);
		if (isset($_POST['action'])) {
			$guest = new \app\models\Guest();
			$guest = $guest->getGuestByEmail($_SESSION["email"]);
			$POST = ["item_id" => $item_id, "size" => $_POST["size"], "email" => $_SESSION["email"]];
			$POST = json_encode($POST);
			//WE ALWAYS TO ADD THE AUTHORIZATION HEADER IN HERE TO VERIFY TOKEN IN THE BACKEND!
			//DO THIS WHEN WE FIX TOKEN OK
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token],
				"body" => $POST
			];

			$response = $client->request("POST", "cart/addToCart", $request);
			$contents = $response->getBody()->getContents();
			if ($contents == "Invalid token") {
				$logger->notice("\nUser is being redirected to error page 401");
				header("location: /ErrorPages/error401");
			} else {
				$logger->info("\nUser has added an item to their cart");
				header('location:/Main/index');
			}
		}

		// Use to add the data in the wishlist table
		if (isset($_POST['addToWishlist'])) {
			$wishlist = new \app\models\Wishlist();
			$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json']];
			$response = $client->request('GET', "item/$item_id", $request);
			$contents = $response->getBody()->getContents();
			$contents = json_decode($contents);
			
			if ($wishlist->isItemExist($_SESSION['guest_id'], $item_id)) {
				$this->quickShopButton($item_id);
				return;
			} else {
				$wishlist->item_name = $contents->item_name;
				$wishlist->item_price = $contents->item_price;
				$wishlist->image_url = $contents->image_url;
				$wishlist->addWishlist($_SESSION['guest_id'], $item_id);
				$this->quickShopButton($item_id);
				return;
			}
		}
		$this->view('Main/cart');
	}

	public function getAllItemsForCart() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		
		$guest = new \app\models\Guest();
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		$email = json_encode(["email" => $guest->email]);
		$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => 'Bearer ' . $guest->token], "body" => $email];
		$response = $client->request('POST', "checkout/".$guest->email, $request);
		$contents = json_decode($response->getBody()->getContents());

		// if (!is_array($contents)) {
		// 	header("location: /ErrorPages/error401");

		// 	$logger->notice("\nUser is being redirected to error page 401");
		// }
		echo "Hello ". $contents;
		$this->view('Main/cart', $contents);
	}

	public function goToWishlist() {
		$wishlist = new \app\models\Wishlist();
		$wishlists = $wishlist->getAllWishlist($_SESSION['guest_id']);

		$this->view('Main/wishlist', $wishlists);
	}

	public function removeToWishlist($item_id) {
		$wishlist = new \app\models\Wishlist();
		if(isset($_POST['removeItem'])) {
			$wishlist->deletewishlist($_SESSION['guest_id'], $item_id);
		}
		$wishlists = $wishlist->getAllWishlist($_SESSION['guest_id']);

		$this->view('Main/wishlist', $wishlists);
	}

}