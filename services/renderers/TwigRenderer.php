<?php

namespace app\services\renderers;


class TwigRenderer  implements IRender
{
    public function render($template, $params = []) {
        $templatePath = VIEWS_DIR . $template . ".php";

        var_dump($params, "<br>!!!<br>");

        var_dump("<br><br><br>", file_get_contents($templatePath), "<br>&&&<br><br>");

        $loader = new \Twig\Loader\ArrayLoader([
            'index' => file_get_contents($templatePath),
        ]);
        $twig = new \Twig\Environment($loader);
        
        return $twig->render('index', $params );
    }
}