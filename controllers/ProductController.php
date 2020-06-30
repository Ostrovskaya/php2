<?php


namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\base\App;
use app\models\Product;

class ProductController  extends Controller
{
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        echo $this->render("product/catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $id = App::getInstance()->request->get('id');
        $product = (new ProductRepository())->getById($id);
        echo $this->render('product/card', ['product' => $product]);
    }

    public function actionAdd(){
        $request = App::getInstance()->request; 
        if( $request->method() == 'POST') {
            $product = new Product();

            $product->getChangeData($request->post());

            (new ProductRepository())->save($product);

            header('Location: ../product/new');
            exit;
        } 
    }

    public function actionControl(){
        $products = (new ProductRepository())->getAll();
        echo $this->render("product/control", ['products' => $products]);
    }

    public function actionChange(){
        $request = App::getInstance()->request; 
        if( $request->method() == 'POST') {

            $product = new Product();
            $product->id = $request->get('id');
            $product->getChangeData($request->post());

            (new ProductRepository())->save($product);

            header('Location: ../product/control');
            exit;
        } 
    }

    public function actionDelete(){
        $request = App::getInstance()->request; 
        if( $request->method() == 'POST') {
            
            $product = new Product();
            $product->id = (int)$request->post('id');

            (new ProductRepository())->delete($product);

            header('Location: ../product/control');
            exit;
        } 
    }
}