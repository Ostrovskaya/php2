<?php


namespace app\controllers;

use app\services\renderers\IRender;

abstract class Controller
{
    protected $defaultAction = 'index';
    protected $action;
    protected $useLayout = true;
    protected $layout = 'main';

    protected $renderer;

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
            echo "404";
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