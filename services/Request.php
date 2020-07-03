<?php

namespace app\services;

class Request
{
    protected $requestString;
    protected $controllerName = "";
    protected $actionName = "";

    protected $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

    //controller/action?id = .........

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    protected function parseRequest()
    {
        if (preg_match_all($this->pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        }
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }
    
    public function get($name = null) {
        if($name){
            return $_GET[$name];
        }
        return $_GET;
    }
    
    public function post($name = null) {
        if($name){
           return $_POST[$name]; 
        }
        return $_POST; 
    }
    public function request($name = null) {
        if($name){
           return $_REQUEST[$name]; 
        }
        return $_REQUEST; 
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isAjax(): bool
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
    }
}