<?php

require __DIR__ . '/../config/main.php';
require SERVICES_DIR . 'Autoloader.php';

spl_autoload_register([new cervices\Autoloader(), 'loadClass']);

$product = new models\Weighted_Product(150);

var_dump($product);