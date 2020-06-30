<?php


namespace app\models\repositories;


use app\models\Product;

class ProductRepository extends Repository
{
    public function getTableName(): string
    {
        return "catalog";
    }

    public function getRecordClass(): string
    {
        return Product::class;
    }
}