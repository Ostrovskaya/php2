<?php
namespace app\models;

class User extends Record{
    public $id;
    public $login;
    public $password;
    public $email;

    public static function getTableName(): string
    {
        return "users";
    }

    public function saveNewUser() {
        $sql = "INSERT INTO reviews (id, login, password, email) VALUES (:id, :login, :password, :email)";
        return $this->db->execute($sql, [
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
        ]);
    }

    protected function setAll($arr){
        $this->setId($arr['id']);
        $this->setLogin($arr['login']);
        $this->setPassword($arr['password']);
        $this->setEmail($arr['email']);
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


}