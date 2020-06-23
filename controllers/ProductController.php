<?php


namespace app\controllers;


use app\models\Product;

class ProductController  extends Controller
{
    public function actionIndex()
    {
        $products = Product::getAll();

        echo $this->render("product/catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getById($id);
        echo $this->render('product/card', ['product' => $product]);
    }

    public function actionAdd(){
        //
    }
}