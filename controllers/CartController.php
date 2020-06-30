<?php


namespace app\controllers;


use app\models\Cart;
use app\base\App;

class CartController  extends Controller
{

    public function actionIndex()
    {
        $session = App::getInstance()->session;
        $cart = [];
        if ($session->isSession('cart')) {
            
            $cart = (new Cart())->getAll($session->get('cart'));
        }
        echo $this->render("cart", ['products' => $cart]);
    }

    public function actionAdd(){
        $session = App::getInstance()->session;
        $request = App::getInstance()->request;       

        if($request->method() == 'POST') {
            $id = (int)$request->post('id');
            if ( $session->isSession( "cart" , "{$id}") ){
                $session->increaseValue("cart", "{$id}", 1);
            }
            else {
                $session->set("cart", "{$id}", 1);
            }

            $text = "Товар был успешно добавлен в корзину";

            $this->useLayout = false;   
            echo $this->render("msg", ['text' => $text], false);
        }
    }

    public function actionDelete(){
        $request = App::getInstance()->request; 
        if($request->method() == 'POST') {
            $id = $request->post('id');
            App::getInstance()->session->delete("cart" , "{$id}" );
        }
    }
}