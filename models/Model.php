<?php
namespace app\models;

use app\interfaces\ModelInterface;
use app\services\Db;

abstract class Model implements ModelInterface
{
    protected $tableName;
    protected $db = null;

    public function __construct()
    {
        $this->db = Db::getObj();
        $this->tableName = $this->getTableName();
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        $arr = $this->db->queryOne($sql, ['id' => $id]);
        $this->setAll($arr);
        return $this;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($sql);
    }

    abstract protected function setAll($arr);
}