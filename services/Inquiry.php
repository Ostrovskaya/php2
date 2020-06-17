<?php

namespace app\services;

class Inquiry
{
    public static function get($name) {
        return $_GET[$name];
    }
    
    public static function post($name) {
        if($name){
           return $_POST[$name]; 
        }
        return $_POST; 
    }
}