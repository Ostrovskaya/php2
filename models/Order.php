<?php
namespace app\models;
use app\models\repositories\ProductRepository;

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

    public function setData($session,$post, $products){        
        $this->getChangeData($post);
        $this->changeData['user_id'] =(int)$session->get('user', 'id');
        foreach ($products as $product) {
            $count = $session->get('cart' , $product['id']);

            $this->changeData['total_price'] += (int)$product['price'] * $count;
            $this->changeData['count'] += $count;
        }
    }

    public function getAll($items){ 
        $order = [];
        $productsIds = array_keys($items); 
        $products = (new ProductRepository())->getByIds($productsIds);
        foreach ($products as $product) {    
            $count = $items[$product['id']];   
            $order['products'][] = [
                'product' => $product,
                'count' => $count,
            ];
            $total_price += (int)$product['price'] * $count;
            $total_count += $count;
        }
        $order['total_price'] = $total_price;
        $order['count'] = $total_count;
        return $order;

    }
}