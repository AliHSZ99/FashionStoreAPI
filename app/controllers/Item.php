<?php

namespace app\controllers;

include "\\xampp\\htdocs\\vendor\\autoload.php";

class Item extends \app\core\Controller {

    /*
    I commented this entire method because it was used to populate
    the Item table for the database from the ASOS API.
    */
    
    // public function populateItemTable() {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://asos2.p.rapidapi.com/products/v2/list?store=US&offset=0&categoryId=5668&limit=2&country=US&sort=freshness&currency=USD&sizeSchema=US&lang=en-US",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => [
    //             "X-RapidAPI-Host: asos2.p.rapidapi.com",a849a8bddmshffd9de8d009abc0p1aa325jsn426a4adc6bea"
    //             "X-RapidAPI-Key: a
    //         ],
    //     ]);

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         $data = json_decode($response, TRUE);
    //         $item1 = new \app\models\Item;
    //         $item1->item_name = $data['products'][0]['name'];
    //         $item1->item_type = $data['categoryName'];
    //         $item1->item_brand = $data['products'][0]['brandName'];
    //         $item1->item_color = $data['products'][0]['colour'];
    //         $item1->item_price = $data['products'][0]['price']['current']['value'];
    //         $item1->image_url = $data['products'][0]['imageUrl'];
    //         $item1->insertItem();

    //         $item2 = new \app\models\Item;
    //         $item2->item_name = $data['products'][1]['name'];
    //         $item2->item_type = $data['categoryName'];
    //         $item2->item_brand = $data['products'][1]['brandName'];
    //         $item2->item_color = $data['products'][1]['colour'];
    //         $item2->item_price = $data['products'][1]['price']['current']['value'];
    //         $item2->image_url = $data['products'][1]['imageUrl'];
    //         $item2->insertItem();

    //         echo 'items inserted!';
    //     }
        
    // }
    
}