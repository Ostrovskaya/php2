<?php

namespace models;

class Digital_Product extends Product{
    protected $type = "digital";

    public function getTotalPrice(){
        return $this->getPrice() / 2;
    } 
}