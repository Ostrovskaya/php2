<?php


namespace app\controllers;


use app\services\Session;
use app\services\Server;
use app\services\Inquiry;
use app\models\Product;

class CartController  extends Controller
{

    public function actionIndex()
    {
        $cart = [];

        if (Session::isSession('cart')) {
            $productsIds = array_keys(Session::get('cart'));
            $products = Product::getByIds($productsIds);
            foreach ($products as $product) {
                
                $cart[] = [
                    'id' => $product['id'],
                    'url' => $product['url'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'count' => Session::get('cart' , $product['id']),
                ];
            }
        }

        echo $this->render("cart", ['products' => $cart]);
    }

    public function actionAdd(){
        if(Server::get('REQUEST_METHOD') == 'POST') {

            $id = (int)Inquiry::post('id');
        
            if ( Session::isSession( "cart" , "{$id}") ){
                Session::increaseValue("cart", "{$id}", 1);
            }
            else {
                Session::set("cart", [ "{$id}", 1]);
            }

            $text = "Товар был успешно добавлен в корзину";
        
            echo $this->render("msg", ['text' => $text], false);
        }
    }

    public function actionDelete(){
        if(Server::get('REQUEST_METHOD') == 'POST') {
            $id = Inquiry::post('id');
            Session::delete([ "cart" , "{$id}" ]);
        }
    }
}