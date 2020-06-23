<?php

namespace app\services;

class Inquiry
{
    public static function get($name) {
        return $_GET[$name];
    }
    
    public static function post($name = null) {
        if($name){
           return $_POST[$name]; 
        }
        return $_POST; 
    }
    public static function request($name) {
        if($name){
           return $_REQUEST[$name]; 
        }
        return $_REQUEST; 
    }
}