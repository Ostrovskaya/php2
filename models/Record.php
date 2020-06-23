<?php

namespace app\models;

use app\interfaces\IRecord;
use app\services\Db;

abstract class Record implements IRecord
{
    public $id;
    protected $db = null;

    public $changeData = [];

    public function __construct()
    {
        $this->db = Db::getInstance();
    }
    
    public function getChangeData(array $data){
        foreach ($data as $key => $value) {
            $this->changeData[$key] = $value;
        }
    }
    
    public static function getById(int $id): Record
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject(get_called_class(), $sql, [':id' => $id])[0];
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public static function getByIds(array $ids)
    {
        $tableName = static::getTableName();

        foreach ($ids as $key => $id) {

            $params["id{$key}"] = $id;
            $placeholders[] = ":id{$key}";
        }
        $placeholders = implode(", ", $placeholders);

        $sql = "SELECT * FROM {$tableName} WHERE id IN ({$placeholders})";
        
        return Db::getInstance()->queryAll($sql, $params);
    }

    public function delete()
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }

    public function insert()
    {
        $tableName = static::getTableName();

        $params = [];
        $columns = [];

        foreach ($this->changeData as $key => $value) {

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLastInsertId();
    }

    public function update()
    {
        $tableName = static::getTableName();
        
        $params = ['id' => $this->id];

        foreach ($this->changeData as $key => $value) {

            if(isset($value)){
                $params["{$key}"] = $value;
                $placeholders[] = "{$key}=:{$key}";
            }       
        }

        if(!empty($placeholders)){
            $placeholders = implode(", ", $placeholders);

            $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";
        
            $this->db->execute($sql, $params);
            $this->id = $this->db->getLastInsertId();
        }    
    }

    public function save()
    {
        if(!empty($this->id)){
            var_dump("update");
            $this->update();
        } 
        else{
            var_dump("insert");
           $this->insert(); 
        } 

        $this->saveData();
    }

    protected function saveData(){
        foreach ($this->changeData as $key => $value) {
            if(isset($value)){
                $this->$key = $value;
                $this->changeData[$key] = null;
            }       
        } 
    }
}