<?php

namespace app\services\renderers;


class TwigRenderer  implements IRender
{
    public function render($template, $params = []) {
        //$templatePath = VIEWS_DIR . $template . ".php";

        $loader = new \Twig\Loader\FilesystemLoader(VIEWS_DIR . 'twig');

        /*$loader = new \Twig\Loader\ArrayLoader([
            'index' => file_get_contents($templatePath),
        ]);*/
        $twig = new \Twig\Environment($loader, []);
        $template .= ".twig";
        return $twig->render('index', $params );
    }
}