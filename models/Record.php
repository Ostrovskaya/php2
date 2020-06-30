<?php

namespace app\models;


use app\services\Db;

abstract class Record
{
    public $id;

    public $changeData = [];

    public function getChangeData(array $data){
        foreach ($data as $key => $value) {
            $this->changeData[$key] = $value;
        }
    }

    public function saveData(){
        foreach ($this->changeData as $key => $value) {
            if(isset($value)){
                $this->$key = $value;
                $this->changeData[$key] = null;
            }       
        } 
    }

   

    
}