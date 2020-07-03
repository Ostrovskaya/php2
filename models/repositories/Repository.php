<?php


namespace app\models\repositories;

use app\models\Record;
use app\services\Db;
use app\interfaces\IRecord;
use app\base\App;

abstract class Repository  implements IRecord
{
    protected $db = null;

    public function __construct()
    {
        $this->db = App::getInstance()->db;
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
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

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

        $result = $this->db->execute($sql, $params);
        
        $record->id = $this->db->getLastInsertId();

        return $result;
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
        
            return $this->db->execute($sql, $params);
        }    
    }

    public function save(Record $record)
    {   
        if(!empty($record->id)){
            $result = $this->update($record);
        } 
        else{
           $result = $this->insert($record); 
        } 

        $record->saveData();

        return $result;
    }

    abstract public function getRecordClass(): string;
}