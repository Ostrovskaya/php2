<?php


namespace app\controllers;


use app\services\Session;
use app\models\Product;

class ProductController  extends Controller
{

    public function actionIndex()
    {
        $cart = [];

        if (!empty(Session::get('cart'))) {
            $productsIds = array_keys(Session::get('cart'));

            foreach ($productsIds as $id) {
                $product = Product::getById($id);
                $cart[] = [
                    'id' => $product['id'],
                    'url' => $product['url'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'count' => Session::get(['cart' , $product['id']]),
                ];
            }
        }

        echo $this->render("cart", ['products' => $cart]);
    }
}