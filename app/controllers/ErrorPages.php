<?php
namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";

class ErrorPages extends \app\core\Controller {
	
	public function error401() {
		$this->view("Error/error401");
	}

}