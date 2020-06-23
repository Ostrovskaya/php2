<?php

namespace app\services;

use app\traits\TSingleton;

class Db
{
    use TSingleton;
    
    private static $conn = null;

    private $config = [
        "host" => "127.0.0.1",
        "user" => "root",
        "password" => "root",
        "db" => "shop",
        'charset' => 'utf8',
    ];

    private function getConnection() {
        if(is_null($this->conn)){
            $this->conn = new \PDO(
                $this->getDsn(),
                $this->config['user'],
                $this->config['password'],
                $this->getOpt(),
            );
        }
        return $this->conn;
    }

    public function getLastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    public function queryObject($className, string $sql, array $params = [])
    {
        $pdoStatement = $this->query($sql, $params);
        $pdoStatement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $className);
        return $pdoStatement->fetchAll();
    }

    private function query($sql, $param=[]){
        $pdos = $this->getConnection()->prepare($sql);
        $pdos->execute($param);
        return $pdos;
    }

    public function execute(string $sql, array $param = [])
    {
        return $this->query($sql, $param)->rowCount();
    }
    
    public function queryOne(string $sql, array $param = [])
    {
        return $this->queryAll($sql, $param)[0];
    }

    public function queryAll(string $sql, array $param = [])
    {
        return $this->query($sql, $param)->fetchAll();
    }

    private function getDsn(){
        $format = 'mysql:host=%1s;dbname=%2s;charset=%3s';
        return sprintf($format, $this->config["host"], $this->config["db"], $this->config["charset"]);
    }

    private function getOpt(){
        return [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
    }
}