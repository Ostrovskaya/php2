<?php

namespace app\services;

class Session{

    protected static function getStart() {
        if(is_null($_SESSION)){
            session_start();
        }
    }
    
    public static function set($key, $value) {
        self::getStart();
    
        if(is_array($key))
        {
            $_SESSION[$key[0]][$key[1]] = $value;
        } 
        else{
            $_SESSION[$key] = $value;
        }
    }
    
    public static function get($key) {
        self::getStart();
    
        if(is_array($key))
        {
            return $_SESSION[$key[0]][$key[1]];
        } 
        else{
            return $_SESSION[$key];
        }
    }
    
    public static function delete($key) {
        self::getStart();
    
        if(is_array($key))
        {
            unset($_SESSION[$key[0]][$key[1]]);
        } 
        else{
            unset($_SESSION[$key]);
        }
    }
    
    public static function increaseValue($key, $value) {
        self::getStart();
    
        if(is_array($key))
        {
            $_SESSION[$key[0]][$key[1]] += $value;
        } 
        else{
            $_SESSION[$key] += $value;
        }
    }
    
    public static function isSession($key) {
        self::getStart();
    
        if(is_array($key))
        {
            return isset( $_SESSION[$key[0]][$key[1]]);
        } 
        else{
            return isset($_SESSION[$key]);
        }
    }
}