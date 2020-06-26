<?php


namespace app\controllers;

use app\services\Session;
use app\services\Request;
use app\services\Hash;
use app\models\repositories\UserRepository;
use app\models\User;

class UserController  extends Controller
{
    public function actionIndex()
    {
        $id = Session::get('user', 'id');
        $user = (new UserRepository())->getById($id);
        echo $this->render("user/personal", ['user' => $user]);
    }

    public function actionAdd(){
        if( Request::method() == 'POST') {
            $user = new User();

            $user->getChangeData(Request::post());
            $user->changeData['password'] = Hash::get($user->changeData['password']);
            (new UserRepository())->save($user);
            Session::set("user", [ 
                "id" => $user->id,
                "name" => $user->name,
            ]);
            echo $this->render("user/personal", ['user' => $user]);
        } 
    }
    public function actionLogin(){
        echo $this->render("user/login");
    }

    public function actionReg(){
        echo $this->render("user/reg");
    }

    public function actionEnter(){
        if(Request::method() == 'POST') {
            $login = Request::post('login');
            $password = Request::post('password');
            $user = (new UserRepository())->getByLogin($login);
            var_dump($user, "<br><br>");
            if($user && $user->password == Hash::get($password)){
                Session::set("user", [ 
                    "id" => $user->id,
                    "name" => $user->name,
                ]);
                echo $this->render("user/personal", ['user' => $user]);
            }else {
                echo "Не верный логин или пароль!";
                echo $this->render("user/login");
            } 
        }
    }

    public function actionLogout(){
        Session::delete("user");
        echo $this->render("user/login");
    }


}