<?php


namespace app\models\repositories;


use app\models\OrderProduct;

class OrderProductRepository extends Repository
{
    public function getTableName(): string
    {
        return "products";
    }

    public function getRecordClass(): string
    {
        return OrderProduct::class;
    }
}