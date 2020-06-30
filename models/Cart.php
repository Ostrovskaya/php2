<?php
namespace app\models;

use app\models\repositories\ProductRepository;

class Cart {
    public function getAll($items){ 
        $cart = [];
        $productsIds = array_keys($items); 
        $products = (new ProductRepository())->getByIds($productsIds);
        foreach ($products as $product) {        
            $cart[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'count' => $items[$product['id']],
            ];
        }
        return $cart;
    }
    
}