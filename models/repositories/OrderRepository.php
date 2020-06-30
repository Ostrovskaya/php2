<?php


namespace app\models\repositories;


use app\models\Order;

class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return "Orders";
    }

    public function getRecordClass(): string
    {
        return Order::class;
    }
}