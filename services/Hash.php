<?php

namespace app\services;

class Hash{
    public static function get($string) {
        return md5($string . "d5f8");
    }
}



