<?php

namespace app\interfaces;
use app\models\Record;


interface IRecord
{
    public function getById(int $id);

    public function getAll();

    public function getTableName(): string;

    public function delete(Record $record);

    public function insert(Record $record);

    public function update(Record $record);

    public function save(Record $record);
}