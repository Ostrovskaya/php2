<?php

namespace app\traits;


/**
 * шаблон по типу Singlton
 */
trait TSingleton {
    private  static $obj = null; 

    private function __consruct() {}

    private function __wakeup() {}

    private function __clone() {}

    public static function getInstance() {
        if(static::$obj == null) {
            static::$obj = new static ();
        }

        return static::$obj;
    }
}
