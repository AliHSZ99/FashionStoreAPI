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

        public function populateItemTable() {
            $curl = curl_init();
    
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://asos2.p.rapidapi.com/products/v2/list?store=US&offset=0&categoryId=5668&limit=9&country=US&sort=freshness&currency=USD&sizeSchema=US&lang=en-US",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: asos2.p.rapidapi.com",
                    "X-RapidAPI-Key: aa849a8bddmshffd9de8d009abc0p1aa325jsn426a4adc6bea"
                ],
            ]);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
    
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                for ($i = 0; $i < 9; $i++) {
                    $data = json_decode($response, TRUE);
                    $item1 = new webservice\model\Item;
                    $item1->item_name = $data['products'][$i]['name'];
                    $item1->item_type = $data['categoryName'];
                    $item1->item_brand = $data['products'][$i]['brandName'];
                    $item1->item_color = $data['products'][$i]['colour'];
                    $item1->item_price = $data['products'][$i]['price']['current']['value'];
                    $item1->image_url = $data['products'][$i]['imageUrl'];
                    $item1->insertItem();
                }
    
                echo 'items inserted!';
            }
            
        }

    }
  
?>