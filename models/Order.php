<?php
namespace app\models;

class Order extends Model
{
    protected $id;
    protected $userId;
    protected $totalPrice;
    protected $productsList;
    protected $date;
    protected $status;

    public function getTableName(): string
    {
        return "Orders";
    }

    public function saveNewOrder() {
        $sql = "INSERT INTO reviews (id, user_id, total_price, category_id, date, status) VALUES (:id, :userId, :totalPrice, :date, :status)";
        return $this->db->execute($sql, [
            'id' => $this->getId(),
            'userId' => $this->getUserId(),
            'totalPrice' => $this->getTotalPrice(),
            'date' => $this->getDate(),
            'status' => $this->getStatus(),
        ]);
    }

    protected function setAll($arr){
        $this->setId($arr['id']);
        $this->setUserId($arr['userId']);
        $this->setTotalPrice($arr['totalPrice']);
        $this->setDate($arr['date']);
        $this->setStatus($arr['status']);
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