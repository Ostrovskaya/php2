<?php

namespace app\services;

class Session{

    public function __construct() {
        if(is_null($_SESSION)){
            session_start();
        }
    }
    
    public function set($name, $key, $value) {
        $_SESSION[$name][$key] = $value;
    }
    
    public function get($name, $key = null) {
        if(isset($key))
        {
            return $_SESSION[$name][$key];
        } 
        else{
            return $_SESSION[$name];
        }
    }
    
    public function delete($name, $key = null) {
    
        if(isset($key))
        {
            unset($_SESSION[$name][$key]);
        } 
        else{
            unset($_SESSION[$name]);
        }
    }
    
    public function increaseValue($name, $key, $value) {
    
        $_SESSION[$name][$key] += $value;
    }
    
    public function isSession($name, $key = null) {
    
        if(isset($key))
        {
            return isset( $_SESSION[$name][$key]);
        } 
        else{
            return isset($_SESSION[$name]);
        }
    }
}