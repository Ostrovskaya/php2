<?php
namespace app\models;

use app\services\Session;

use app\services\Db;

class User extends Record{
    public $login;
    public $name;
    public $surname;
    public $password;
    public $email;

    public $admin = false;

    public $changeData = [
        'login' => null,
        'password' => null,
        'email' => null,
        'name' => null,
        'surname' => null,
    ];

    public static function getByLogin($login) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE login = :login";
        return Db::getInstance()->queryObject(get_called_class(), $sql, [':login' => $login])[0];
    }

    public static function isLogin(){
        return !empty(Session::get('user'));
    }

    public static function getUserName(){
        return Session::get('user', 'name');
    }
    

    public static function getTableName(): string
    {
        return "users";
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
    public function getLogin()
    {
        return $this->login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }
    public function getSurname()
    {
        return $this->surname;
    }
}