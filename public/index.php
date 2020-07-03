<?php

use app\base\App;

include "../vendor/autoload.php";
$config =  include  "../config/main.php";

App::getInstance()->run($config);




