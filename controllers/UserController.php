<?php


namespace app\controllers;

use app\base\App;
use app\models\repositories\UserRepository;
use app\models\User;

class UserController  extends Controller
{
    public function actionIndex()
    {
        $id = App::getInstance()->session->get('user', 'id');
        $user = (new UserRepository())->getById($id);
        echo $this->render("user/personal", ['user' => $user]);
    }

    public function actionAdd(){
        $request = App::getInstance()->request; 
        if( $request->method() == 'POST') {
            $user = new User();

            $user->getChangeData($request->post());
            $user->changeData['password'] = App::getInstance()->hash->get($user->changeData['password']);
            (new UserRepository())->save($user);
            App::getInstance()->session->set("user", [ 
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
        $request = App::getInstance()->request; 
        if($request->method() == 'POST') {
            $login = $request->post('login');
            $password = $request->post('password');
            $user = (new UserRepository())->getByLogin($login);

            if($user && $user->password == (new Hash())->get($password)){
                App::getInstance()->session->set("user", [ 
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
        App::getInstance()->session->delete("user");
        echo $this->render("user/login");
    }


}