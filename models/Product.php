<?php
namespace app\models;

class Product extends Record
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;

    public $changeData = [
        'id' => null,
        'name' => null,
        'description' => null,
        'price' => null,
        'category_id' => null,
    ];
}