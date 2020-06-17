<?php

namespace app\models;

use app\interfaces\IRecord;
use app\services\Db;

abstract class Record implements IRecord
{
    public $id;
    protected $db = null;

    public function __construct()
    {
        $this->db = Db::getInstance();
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

        foreach ($this as $key => $value) {
            if(in_array($key,['db', 'tableName'])) {
                continue;
            }

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

        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $old = Db::getInstance()->queryOne($sql, [':id' => $this->id]);
        
        $params = ['id' => $this->id];

        foreach ($this as $key => $value) {
            if(in_array($key,['db', 'tableName'])) {
                continue;
            }

            if($value != $old[$key]){
                
                $params["{$key}"] = $value;
                $placeholders[] = "{$key}=:{$key}";
            }        
        }

        if(empty($placeholders)){
            $placeholders = implode(", ", $placeholders);

            $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";
        
            $this->db->execute($sql, $params);
            $this->id = $this->db->getLastInsertId();
        }    
    }

    public function save()
    {
        $tableName = static::getTableName();

        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $result = Db::getInstance()->queryOne($sql, [':id' => $this->id]);

        if(!empty($result)){
            $this->update();
        } 
        else{
           $this->insert(); 
        } 
    }
}