<?php

namespace app\interfaces;

interface IRecord
{
    public static function getById(int $id): IRecord;

    public static function getALl();

    public static function getTableName(): string;

    public function delete();

    public function insert();

    public function update();

    public function save();
}