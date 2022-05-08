<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Main extends \app\core\Controller {
	
	// The main page where all the items are displayed. 
	public function index()
	{
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		// Creating a client for request. 
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		$tokenWithBearer = "";
		// Checking if the user has a token, if not, it requests for one. 
		if ($guest->token == "") {
			$logger->info("\nUser with id $guest->guest_id and email {$_SESSION['email']} has no token and is trying to authenticate");

			$POST = ["guest_id" => $_SESSION["guest_id"], "apikey" => $guest->api_key];
			$POST = json_encode($POST);
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json'], 
				"body" => $POST
			];

			// User getting the token in the response and storing it in the database.
			$response = $client->request("POST", "auth/index", $request);
			$tokenWithBearer = $response->getHeader('WWWW-Authenticate')[0];
			$splitToken = explode(" ", $tokenWithBearer);
			$token = $splitToken[1];
			$guest->token = $token;
			$guest->addToken();
		}

		// Creating request for all items to be displayed using the token. 
		$tokenWithBearer = "Bearer ".$guest->token;
		$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => $tokenWithBearer]];
		$response = $client->request('GET', 'item/getAll', $request);
		$contents = $response->getBody()->getContents();
		$contents = json_decode($contents);
		// If an array is not returned, it means that the token was invalid. The user is redirected to an error page.
		if (!is_array($contents)) {
			header("location: /ErrorPages/error401");

			$logger->notice("\nUser is being redirected to error page 401");
		}

		$logger->info("\nUser with id $guest->guest_id and email {$_SESSION['email']} has a token and successfully accessed the API");

		$this->view('Main/index', $contents);
	}

	// Brings the user to the about page. 
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

	// Brings the user to their cart page. 
	public function cart() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);

		// Creating request for all items in cart to be displayed in the cart using the user's token.
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$request = ["headers" => ['accept' => 'application/json', 'content-type' => 'application/json', 'Authorization' => "Bearer ".$guest->token],
			"body" => json_encode(["email" => $_SESSION["email"]])];
		// If the checkout button is pressed, the checkout method is called. 
		if (isset($_POST["action"])) {
			header("location:/Main/checkout");
		}
		
		$response = $client->request("GET", "cart/getAllItems", $request);
		$body = $response->getBody()->getContents();
		$body = json_decode($body);
		// If an array is not returned, it means that the token was invalid. The user is redirected to an error page.
		if (!is_array($body)) {
			header("location: /ErrorPages/error401");

			$logger->notice("\nUser is being redirected to error page 401");
		}
		$this->view('Main/cart', $body);
	}

	// This method is called when the user clicks the checkout button.
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
		// Refresh the cart page if no items were in the cart.
		// Send user to the 401 error page if the token is invalid.
		// If the cart had items, remove all items from cart and send user to the checkout page.
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

	// This method is used to generate an API key for a newly registered user.
	public function generateApiKey() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());
		$logger->info("\nAn API key has been generated");

		// Return the API key.
		return "fashionstore". uniqid();

	}

	// This method is used to register a new user by displaying the register page with its form.
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

			// Check if the passwords match.
			if ($password == $passwordConfirm) {
				$guest->password = $password;
				$guest->api_key = $this->generateApiKey();
				$guest->insertGuest();

				// log that a user registered
				$logger->info("\nA user just registered to the website");

				$guest = $guest->getGuestByEmail($_POST['email']);
				// make a POST request to save the new client to the web service. 
				$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
				$POST = ["guest_id" => $guest->guest_id, "apikey" => $guest->api_key, "email" => $guest->email];
				$POST = json_encode($POST);
				$request = [
					"headers" => ['accept' => 'application/json', 'content-type' => 'application/json'], 
					"body" => $POST
				];
				$response = $client->request("POST", "clients/addClient", $request);
				$body = $response->getBody()->getContents();

				// The user gets sent to the login page after this process. 
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

	// The method is used to login a user.
	public function login(){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		// Check if the login button was clicked.
		if (isset($_POST['action'])) {
			$guest = new \app\models\Guest();
			$guest = $guest->getGuestByEmail($_POST['email']);

			// Check user infor before logging them in.
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

	// This method is used to allow the user to go to the settings page.
	public function settings()
	{
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());


		// Check if the logout button was clicked.
		if (isset($_POST["action"])) {
			header("location:/Main/logout");
		}

		// Check if the user entered a new password.
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

	// This method is called when the user clicks on a specific item in the store. 
	public function quickShopButton($item_id){
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);

		// Creating a GET request to get the specific item the user clicked on.
		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token]];
		$response = $client->request('GET', "item/$item_id", $request);
		$contents = $response->getBody()->getContents();
		// Send the user to the 401 error page if an invalid token was used. 
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

	// This method is used to remove a specific item from the cart.
	public function removeFromCart($item_id) {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		$client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost/webservice/api/']);
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		$POST = ["item_id" => $item_id, "email" => $_SESSION["email"]];
		$POST = json_encode($POST);
		//WE ALWAYS TO ADD THE AUTHORIZATION HEADER IN HERE TO VERIFY TOKEN IN THE BACKEND!
		$request = [
			"headers" => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token],
			"body" => $POST
		];

		$response = $client->request("POST", "cart/removeFromCart", $request);
		$contents = $response->getBody()->getContents();
		// Send the user to the 401 error page if an invalid token was used.
		// Allow the user to proceed to the cart page if the item was successfully removed from the cart.
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
		$guest = new \app\models\Guest();
		$guest = $guest->getGuestByEmail($_SESSION["email"]);
		if (isset($_POST['action'])) {
			$POST = ["item_id" => $item_id, "size" => $_POST["size"], "email" => $_SESSION["email"]];
			$POST = json_encode($POST);
			//WE ALWAYS TO ADD THE AUTHORIZATION HEADER IN HERE TO VERIFY TOKEN IN THE BACKEND!
			$request = [
				"headers" => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token],
				"body" => $POST
			];

			$response = $client->request("POST", "cart/addToCart", $request);
			$contents = $response->getBody()->getContents();
			// Send the user to the 401 error page if an invalid token was used.
			// Allow the user to proceed to the main (index) page if the item was successfully added to the cart.
			if ($contents == "Invalid token") {
				$logger->notice("\nUser is being redirected to error page 401");
				header("location: /ErrorPages/error401");
			} else {
				$logger->info("\nUser has added an item to their cart");
				header('location:/Main/index');
			}
		}

		// Use to add the data in the wishlist table (When the add to wishlist button is clicked). 
		if (isset($_POST['addToWishlist'])) {
			$wishlist = new \app\models\Wishlist();
			// Create a request to GET the item from the API. 
			$request = ['headers' => ['accept' => 'application/json', 'content-type' => 'application/json', "Authorization" => "Bearer " . $guest->token]];
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

	// This method is used to bring the user to their wishlist page.
	public function goToWishlist() {
		$wishlist = new \app\models\Wishlist();
		$wishlists = $wishlist->getAllWishlist($_SESSION['guest_id']);

		$this->view('Main/wishlist', $wishlists);
	}

	// This method is used to remove an item from the wishlist.
	public function removeToWishlist($item_id) {
		$wishlist = new \app\models\Wishlist();
		if(isset($_POST['removeItem'])) {
			$wishlist->deletewishlist($_SESSION['guest_id'], $item_id);
		}
		$wishlists = $wishlist->getAllWishlist($_SESSION['guest_id']);

		$this->view('Main/wishlist', $wishlists);
	}

}