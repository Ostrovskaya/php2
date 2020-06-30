<?php


namespace app\controllers;

use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController  extends Controller
{
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        echo $this->render("product/catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $id = (new Request())->get('id');
        $product = (new ProductRepository())->getById($id);
        echo $this->render('product/card', ['product' => $product]);
    }

    public function actionAdd(){
        //
    }
}