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

    public function setData($session, $product, $order){
        $data = [
            "count" => $session->get('cart' , $product['id']),
            "product_id" => (int)$product['id'],
            "order_id" => (int)$order->id,
        ];
        $this->getChangeData($data); 
    }
}