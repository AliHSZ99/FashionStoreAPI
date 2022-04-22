<?php

require(dirname(__DIR__)."\\model\\Item.php");

    class Item {

        function getData($ID) {

            header('content-type: application/json');
            $responsepayload = '';
            $item = new \webservice\model\Item();
            $item = $item->get($ID);
            //$responsepayload = 'The license number of Client '. $client->clientName . ' is: ' . $client->licenseNumber;
            $responsepayload = ['item_id' => $ID, "item_type" => $item->item_type];
            $responsepayload = json_encode($responsepayload);

            return $responsepayload;

        }

    }
  
?>