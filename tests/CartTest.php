<?php

include "../public/index.php";

class CartTest extends \PHPUnit\Framework\TestCase{

    public function testGetAll()
    {
        $model = new app\models\Cart;
        $test = [
            1 => 1,
            2 => 2
        ];
        $products = $model->getAll($test);
        $this->assertIsArray($products);
        $this->assertTrue(count($products) == 2);
        $result = [];
        foreach ($products as $product) {
            $result[$product['id']]  =  $product['count'];
        }
        $this->assertEquals($test, $result);
    }




}