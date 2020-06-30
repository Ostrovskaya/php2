<?php
namespace app\models;
use app\services\Session;

class Order extends Record
{
    public $user_id;
    public $total_price;
    public $adress;
    public $phone;
    public $date;
    public $pay;
    public $count;

    public $changeData = [
        'user_id' => null,
        'total_price' => null,
        'address' => null,
        'date' => null,
        'phone' => null,
        'pay' => null,
        'count' => null,
    ];

    public function setData($post, $products){
        $this->getChangeData($post);
        $this->changeData['user_id'] = Session::get('user', 'id');
        foreach ($products as $product) {
            $count = Session::get('cart' , $product['id']);

            $this->changeData['total_price'] += (int)$product['price'] * $count;
            $this->changeData['count'] += $count;
            $this->changeData['date'] = date('Y-m-d H:i:s');
        }
    }
}