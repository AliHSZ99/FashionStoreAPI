<?php
namespace webservice\models;

require(dirname(__DIR__)."\\core\\Model.php");

class Video extends \webservice\core\Model {

    public $conversionID;
    public $clientID;
    public $requestDate;
    public $requestCompletionDate;
    public $originalFormat;
    public $targetFormat;
    public $inputFile;
    public $outputFile;
 
    public function insert(){
      $SQL = 'INSERT INTO videoconversion(clientID, requestDate, requestCompletionDate, originalFormat, targetFormat, inputFile, outputFile, APIKey) 
              VALUES (:clientID, :requestDate, :requestCompletionDate, :originalFormat, :targetFormat, :inputFile, :outputFile, :APIKey)';
      $STMT = self::$_connection->prepare($SQL);
      $STMT->execute(['clientID'=>$this->clientID, 'requestDate'=>$this->requestDate, 'requestCompletionDate'=>$this->requestCompletionDate, 'originalFormat'=>$this->originalFormat,
           'targetFormat'=>$this->targetFormat, 'inputFile'=>$this->inputFile, 'outputFile'=>$this->outputFile, 'APIKey'=>$this->APIKey]);
    }

}