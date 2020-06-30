<?php

namespace app\services;

class Server{
    public static function get($param) {
        return $_SERVER[$param];
    }
}