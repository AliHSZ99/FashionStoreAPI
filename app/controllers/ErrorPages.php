<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";
include "\\xampp\\htdocs\\vendorLogger\\autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class ErrorPages extends \app\core\Controller {
	
	public function error401() {
		// Create the logger
		$logger = new Logger('my_logger');
		// Now add some handlers
		$logger->pushHandler(new StreamHandler('/xampp/htdocs/app/clientApplication.log', Logger::DEBUG));
		$logger->pushHandler(new FirePHPHandler());

		// You can now use logger
		$logger->notice('Someone unauthorized tried to access a resource');

		$this->view("Error/error401");
	}

}