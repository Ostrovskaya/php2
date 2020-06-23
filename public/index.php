<?php

session_start();
use app\models\Product;
use app\models\User;
use app\services\Inquiry;

use app\services\Session;

require __DIR__ . '/../config/main.php';
require SERVICES_DIR . 'Autoloader.php';
require VENDOR_DIR . 'autoload.php';


spl_autoload_register([new app\services\Autoloader(), 'loadClass']);

$controllerName = Inquiry::request('c') ?: 'product';
$actionName = Inquiry::request('a');

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
    $controller = new $controllerClass(
        new \app\services\renderers\TemplateRenderer()
       //new \app\services\renderers\TwigRenderer()
    );
    $controller->runAction($actionName);
}


