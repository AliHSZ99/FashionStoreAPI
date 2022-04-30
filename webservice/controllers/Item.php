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

        function getAllData() {

            header('content-type: application/json');
            $items = new \webservice\model\Item();
            $items = $items->getItems();
            $itemsPayload = array();
            foreach ($items as $item) {
                $addArray = array();
                $addArray["item_id"] = strval($item->item_id);
                $addArray["item_name"] = strval($item->item_name);
                $addArray["item_type"] = strval($item->item_brand);
                $addArray["item_brand"] = strval($item->item_color);
                $addArray["item_price"] = strval($item->item_price);
                $addArray['image_url'] = strval($item->image_url);
                $itemsPayload[] = $addArray;
            }

            $itemsPayload = json_encode($itemsPayload);

            return $itemsPayload;
        }

    }
  
?>