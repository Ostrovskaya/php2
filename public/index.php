<?php

session_start();

use app\exceptions\PageNotFoundException;


require __DIR__ . '/../config/main.php';
require SERVICES_DIR . 'Autoloader.php';
require VENDOR_DIR . 'autoload.php';


spl_autoload_register([new app\services\Autoloader(), 'loadClass']);


$request = new \app\services\Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
    $controller = new $controllerClass(
        new \app\services\renderers\TemplateRenderer()
       //new \app\services\renderers\TwigRenderer()
    );
    try {
        $controller->runAction($actionName);
    } catch (PageNotFoundException $e) {
        echo $e->getMessage();
    }
}


