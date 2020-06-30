<?php


namespace app\models\repositories;


use app\models\User;
use app\services\Db;

class UserRepository extends Repository
{
    public function getTableName(): string
    {
        return "users";
    }

    public function getRecordClass(): string
    {
        return User::class;
    }

    public function getByLogin($login) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login = :login";
        return Db::getInstance()->queryObject($this->getRecordClass(), $sql, [':login' => $login])[0];
    }
}