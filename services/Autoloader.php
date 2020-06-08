<?php

namespace cervices;

class Autoloader
{
    public function loadClass(string $classname)
    {
        $classname = preg_replace("/\\\\/", "/", $classname);

        $filename = DOCUMENT_ROOT . $classname . ".php";

        if(file_exists($filename)) {
            require $filename;
            return true;
        }
        return false;
    }
}