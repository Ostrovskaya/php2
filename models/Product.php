<?php
namespace app\models;

class Product extends Record
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;

    public static function getTableName(): string
    {
        return "catalog";
    }

    public function getNameClass(){
        return get_called_class();
    }

}