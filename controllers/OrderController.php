<?php


namespace app\controllers;

use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\OrderProductRepository;

use app\models\Order;
use app\models\OrderProduct;

use app\base\App;

class OrderController  extends Controller
{
    public $total_price = 0;
    public $count = 0;
    public $products = [];

    public function actionIndex()
    {
        $session = App::getInstance()->session;
        if ($session->isSession('cart')) {
            $order = (new Order())->getAll($session->get('cart'));
        }
        echo $this->render("order", ['order' => $order]);

    }

    public function actionAdd(){
        $request = App::getInstance()->request; 
        if( $request->method() == 'POST') { 
            $session = App::getInstance()->session;
            $productsIds = array_keys($session->get('cart'));
            $products = (new ProductRepository())->getByIds($productsIds);
            
            $order = new Order();
            $order->setData($session ,$request->post(), $products);

            (new OrderRepository())->save($order);

            
            foreach ($products as $product) {
                $orderProduct = new OrderProduct();
                $orderProduct->setData($session ,$product, $order); 
                    
                (new OrderProductRepository())->save($orderProduct);

            }

            $session->delete('cart');

            header("Location: /");
        }
    }
}