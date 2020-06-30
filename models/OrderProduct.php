<?php
namespace app\models;

class OrderProduct extends Record
{
    public $product_id;
    public $order_id;
    public $count;

    public $changeData = [
        'product_id' => null,
        'order_id' => null,
        'count' => null,
    ];
}