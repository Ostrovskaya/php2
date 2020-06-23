<?php

use app\models\Product;
use app\services\Inquiry;

require __DIR__ . '/../config/main.php';
require SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new app\services\Autoloader(), 'loadClass']);

$controllerName = Inquiry::get('c') ?: 'product';
$actionName = Inquiry::get('a');

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)) {
    $controller = new $controllerClass;
    $controller->runAction($actionName);
}

$product = Product::getById(1);
$product->price=2000;
$product->description="Самая лучшая приставка";
$product->save();