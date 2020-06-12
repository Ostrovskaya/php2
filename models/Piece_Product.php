<?php

namespace models;

class Piece_Product extends Product{
    protected $type = "piece";

    public function getTotalPrice(){
        return $this->getPrice();
    } 
}