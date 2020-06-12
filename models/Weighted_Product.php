<?php

namespace models;

class Weighted_Product extends Product{
    protected $type = "weighted";
    protected $weight;

    public function __construct(int $weight){
        $this->setWeight($weight);
    }

    public function getTotalPrice(){
        return $this->getPrice() *  $this->getWeight();
    }

    public function getWeight(){
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}