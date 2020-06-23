<?php


namespace app\controllers;


use app\models\Product;

class ProductController  extends Controller
{
    public function actionIndex()
    {
        $products = Product::getAll();

        echo $this->render("catalog", ['products' => $products]);
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $model = Product::getById($id);
        echo $this->render('product_card', ['model' => $model]);
    }
}