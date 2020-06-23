<?php

namespace app\services;

class Session{

    protected static function getStart() {
        if(is_null($_SESSION)){
            session_start();
        }
    }
    
    public static function set($name, $array) {
        self::getStart();

        foreach ($array as $key => $value) {
            $_SESSION[$name][$key] = $value;
        }
    
    }
    
    public static function get($name, $key = null) {
        self::getStart();
        if(isset($key))
        {
            return $_SESSION[$name][$key];
        } 
        else{
            return $_SESSION[$name];
        }
    }
    
    public static function delete($name, $key = null) {
        self::getStart();
    
        if(isset($key))
        {
            unset($_SESSION[$name][$key]);
        } 
        else{
            unset($_SESSION[$name]);
        }
    }
    
    public static function increaseValue($name, $key, $value) {
        self::getStart();
    
        $_SESSION[$name][$key] += $value;
    }
    
    public static function isSession($name, $key = null) {
        self::getStart();
    
        if(isset($key))
        {
            return isset( $_SESSION[$name][$key]);
        } 
        else{
            return isset($_SESSION[$name]);
        }
    }
}