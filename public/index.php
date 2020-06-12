<?php

require __DIR__ . '/../config/main.php';
require SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new app\cervices\Autoloader(), 'loadClass']);

$product = new app\models\Product();

var_dump($product->getById(1));