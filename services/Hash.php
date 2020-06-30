<?php

namespace app\services;

class Hash{
    public $salt = "d5f8";
    public function get($string) {
        return md5($string . $this->salt);
    }
}



