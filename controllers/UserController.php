<?php


namespace app\controllers;

use app\services\Session;
use app\services\Server;
use app\services\Inquiry;
use app\services\Hash;

use app\models\User;

class UserController  extends Controller
{
    public function actionIndex()
    {
        $id = Session::get('user', 'id');
        $user = User::getById($id);
        echo $this->render("user/personal", ['user' => $user]);
    }

    public function actionAdd(){
        if( Server::get('REQUEST_METHOD') == 'POST') {
            $user = new User();

            $user->getChangeData(Inquiry::post());
            $user->save();
        } 
    }
    public function actionLogin(){
        echo $this->render("user/login");
    }

    public function actionReg(){
        echo $this->render("user/reg");
    }

    public function actionEnter(){
        if(Server::get('REQUEST_METHOD') == 'POST') {
            $login = Inquiry::post('login');
            $password = Inquiry::post('password');
            $user = User::getByLogin($login);
            
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