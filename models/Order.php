<?php
namespace models;

class Order extends Model
{
    protected $id;
    protected $user_id;
    protected $total_price;
    protected $products_list;
    protected $date;
    protected $status;

    public function getTableName(): string
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

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id): Order
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getTotal_price()
    {
        return $this->total_price;
    }

    public function setTotal_price($total_price): Order
    {
        $this->total_price = $total_price;
        return $this;
    }

    public function getProducts_list()
    {
        return $this->products_list;
    }

    public function setProducts_list($products_list): Order
    {
        $this->products_list = $products_list;
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