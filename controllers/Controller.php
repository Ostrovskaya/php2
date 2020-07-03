<?php


namespace app\controllers;

use app\services\renderers\IRender;
use app\exceptions\PageNotFoundException;

abstract class Controller
{
    public $defaultAction = 'index';
    public $action;
    public $useLayout = true;
    public $layout = 'main';

    public $renderer;

    public function __construct(IRender $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);

        if(method_exists($this, $method)) {
            $this->$method();   
        } else {
            throw new PageNotFoundException("Ошибка 404!");
        }
    }

    abstract public function actionIndex();

    abstract public function actionAdd();


    protected function render($template, $params = []){
        $content = $this->renderer->render($template, $params);
        if($this->useLayout) {
            return $this->renderer->render(
                "layouts/{$this->layout}",
                ['content' => $content]
            );
        }
        return $content;
    }

}