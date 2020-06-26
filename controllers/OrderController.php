<?php


namespace app\controllers;


use app\services\Session;
use app\services\Request;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\OrderProductRepository;

use app\models\Order;
use app\models\OrderProduct;

class OrderController  extends Controller
{
    public $total_price = 0;
    public $count = 0;
    public $products = [];

    public function actionIndex()
    {
        if (Session::isSession('cart')) {
            $productsIds = array_keys(Session::get('cart'));
            $products = (new ProductRepository())->getByIds($productsIds);

            foreach ($products as $product) {
                $count = Session::get('cart' , $product['id']);
                $this->products[] = [
                    'product' => $product,
                    'count' => $count,
                ];
                $this->total_price += (int)$product['price'] * $count;
                $this->count += $count;
            }
        }
        echo $this->render("order", ['order' => $this]);

    }



    public function actionAdd(){
        if( Request::method() == 'POST') { 
            $productsIds = array_keys(Session::get('cart'));
            $products = (new ProductRepository())->getByIds($productsIds);
            
            $order = new Order();
            $order->setData(Request::post(), $products);

            (new OrderRepository())->save($order);

            
            foreach ($products as $product) {
                $orderProduct = new OrderProduct();
                $data = [
                    "count" => Session::get('cart' , $product['id']),
                    "product_id" => $product['id'],
                    "order_id" => $order->id,
                ];
                $orderProduct->getChangeData($data); 
                    
                (new OrderProductRepository())->save($orderProduct);

            }

            Session::delete('cart');

            header("Location: /");
        }
    }
}