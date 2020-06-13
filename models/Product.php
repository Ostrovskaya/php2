<?php
namespace app\models;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $categoryId;

    public function getTableName(): string
    {
        return "catalog";
    }


    public function saveNewProduct() {
        $sql = "INSERT INTO reviews (id, name, price, category_id, description) VALUES (:id, :name, :price, :categoryId, :description)";
        return $this->db->execute($sql, [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'categoryId' => $this->getCategoryId(),
            'description' => $this->getDescription(),
        ]);
    }

    protected function setAll($arr){
        $this->setId($arr['id']);
        $this->setName($arr['name']);
        $this->setDescription($arr['description']);
        $this->setPrice($arr['price']);
        $this->setCategoryId($arr['categoryId']);
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }


}