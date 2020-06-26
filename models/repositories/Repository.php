<?php


namespace app\models\repositories;

use app\models\Record;
use app\services\Db;
use app\interfaces\IRecord;

abstract class Repository  implements IRecord
{
    protected $db = null;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }
    
    public function getById(int $id): Record
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($this->getRecordClass(), $sql, [':id' => $id])[0];
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);
    }

    public function getByIds(array $ids)
    {
        $tableName = $this->getTableName();

        foreach ($ids as $key => $id) {

            $params["id{$key}"] = $id;
            $placeholders[] = ":id{$key}";
        }
        $placeholders = implode(", ", $placeholders);

        $sql = "SELECT * FROM {$tableName} WHERE id IN ({$placeholders})";
        
        return $this->db->queryAll($sql, $params);
    }

    public function delete(Record $record)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $record->id]);
    }

    public function insert(Record $record)
    {
        $tableName = $this->getTableName();

        $params = [];
        $columns = [];

        foreach ($record->changeData as $key => $value) {

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        echo '<pre>'; 
        var_dump($sql);   
        var_dump($params);     
        echo '</pre>'; 
        $record->id = $this->db->getLastInsertId();
    }

    public function update(Record $record)
    {
        $tableName = $this->getTableName();
        
        $params = ['id' => $record->id];

        foreach ($record->changeData as $key => $value) {

            if(isset($value)){
                $params["{$key}"] = $value;
                $placeholders[] = "{$key}=:{$key}";
            }       
        }

        if(!empty($placeholders)){
            $placeholders = implode(", ", $placeholders);

            $sql = "UPDATE {$tableName} SET {$placeholders} WHERE id = :id";
        
            $this->db->execute($sql, $params);
        }    
    }

    public function save(Record $record)
    {
        if(!empty($record->id)){
            $this->update($record);
        } 
        else{
           $this->insert($record); 
        } 

        $record->saveData();
    }

    abstract public function getRecordClass(): string;
}