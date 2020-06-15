<?php

namespace app\services;

class Autoloader
{
    public function loadClass(string $classname)
    {
        $classname = str_replace('app\\', DOCUMENT_ROOT, $classname);
        $filename = realpath("{$classname}.php");
        
        if(file_exists($filename)) {
            require $filename;
            return true;
        }
        return false;
    }
}