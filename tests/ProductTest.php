<?php

include "../public/index.php";

class ProductTest extends \PHPUnit\Framework\TestCase{

    public function testGetAll()
    {
        $rep = new app\models\repositories\ProductRepository;
        $products = $rep->getAll();
        $this->assertIsArray($products);
        $this->assertTrue(count($products)>0);
    }

    public function testGetByIds()
    {
        $rep = new app\models\repositories\ProductRepository;
        $arr = [1, 2];
        $products = $rep->getByIds($arr);
        
        $this->assertIsArray($products);
        $this->assertTrue(count($products) == 2);

        $result = [];
        foreach ($products as $product) {
            $result[] =  $product['id'];
        }
        $this->assertEquals($arr, $result);
    }
    


}