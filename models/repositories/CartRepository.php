<?php


namespace app\models\repositories;


use app\models\Cart;

class CartRepository extends Repository
{
    public static function getTableName(): string
    {
        return "cart";
    }

    public function getRecordClass(): string
    {
        return Cart::class;
    }
}