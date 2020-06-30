<?php


namespace app\models\repositories;


use app\models\Order;
use app\models\Record;

class OrderRepository extends Repository
{
    public function getTableName(): string
    {
        return "Orders";
    }

    public function getRecordClass(): string
    {
        return Order::class;
    }

    public function insert(Record $record)
    {
        $tableName = $this->getTableName();

        $params = [];
        $columns = [];
        unset($record->changeData['date']);
        foreach ($record->changeData as $key => $value) {

            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }

        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}, `date`) VALUES ({$placeholders}, NOW())";
        
        $this->db->execute($sql, $params);
        
        $record->id = $this->db->getLastInsertId();
    }
}