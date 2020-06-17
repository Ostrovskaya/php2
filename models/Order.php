<?php
namespace app\models;

class Order extends Record
{
    protected $id;
    protected $userId;
    protected $totalPrice;
    protected $productsList;
    protected $date;
    protected $status;

    public static function getTableName(): string
    {
        return "Orders";
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId): Order
    {
        $this->userId = $userId;
        return $this;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    public function setTotalPrice($totalPrice): Order
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getProductsList()
    {
        return $this->productsList;
    }
    public function setProductsList($productsList): Order
    {
        $this->productsList = $productsList;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date): Order
    {
        $this->date = $date;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status): Order
    {
        $this->status = $status;
        return $this;
    }
}