<?php

namespace app\services;

class Server{
    public static function server($param) {
        return $_SERVER[$param];
    }
}