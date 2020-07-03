<?php


namespace app\services\renderers;


class TemplateRenderer implements IRender
{
    public function render($template, $params = []) {
        ob_start();
        $templatePath = \app\base\App::getInstance()->getConfig('viewsDir')  . $template . ".php";
        extract($params);
        include $templatePath;
        return ob_get_clean();
    }
}