<?php
namespace webservice\core;

class Model{

	protected static $_connection = null;

	public function __construct(){

		$xml = simplexml_load_file(dirname(__DIR__)."\\core\\database.xml") or die("Error: Cannot create object");
		$username = $xml->user;
		$password = $xml->password;
		$host = $xml->host;
		$DBname = $xml->dbname; 

		if(self::$_connection == null){
			self::$_connection = new \PDO("mysql:host=$host;dbname=$DBname",$username,$password);
		}
	}
}
