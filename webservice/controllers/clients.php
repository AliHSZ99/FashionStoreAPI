<?php

require(dirname(__DIR__)."\\model\\Client.php");

    class clients {

        function getData($ID){

            header('content-type: application/json');
            $responsepayload = '';
            $client = new \webservice\models\Client();
            $client = $client->get($ID);
            //$responsepayload = 'The license number of Client '. $client->clientName . ' is: ' . $client->licenseNumber;
            $responsepayload = ['client_id' => $ID, 'licenseNumber' => $client->licenseNumber];
            $responsepayload = json_encode($responsepayload);

            return $responsepayload;

        }

        

    }
  
?>