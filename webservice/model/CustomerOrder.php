<?php

namespace app\models;

require(dirname(__DIR__)."\\core\\Model.php");

class CustomerOrder extends \app\core\Model {

    public $order_id;
    public $order_date;
    public $total;
    public $status;
    public $guest_id;

    public function __construct() {
        parent::__construct();
    }

}

