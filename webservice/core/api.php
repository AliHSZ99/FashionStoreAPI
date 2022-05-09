<?php


require("C:\\xampp\\htdocs\\vendorSwagger\\autoload.php");
require("C:\\xampp\\htdocs\\webservice\\api\\index.php");

$openapi = \OpenApi\Generator::scan(['C:\\xampp\\htdocs\\webservice\\api']);

header('Content-Type: text/plain');
echo $openapi->toYaml();