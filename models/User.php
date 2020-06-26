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

    public static function isLogin(){
        return !empty(Session::get('user'));
    }

    public static function getUserName(){
        return Session::get('user', 'name');
    }
}