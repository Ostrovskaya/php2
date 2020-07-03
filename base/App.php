<?php


namespace app\base;


use app\exceptions\PageNotFoundException;
use app\services\Db;
use app\services\renderers\TemplateRenderer;
use app\services\Request;
use app\traits\TSingleton;

/**
 * Class App
 * @package app\base
 * @property Request $request
 * @property TemplateRenderer $renderer
 * @property Db $connection
 */
class App
{
    protected $config;
    protected $components = [];

    use TSingleton;

    public function run(array $config)
    {
        $this->config = $config;
        $this->runController();
    }

    public function runController()
    {
        $request = new \app\services\Request();
        
        $controllerName = $request->getControllerName() ?: $this->getConfig('defaultController');
        $actionName = $request->getActionName();

        $controllerClass = $this->getConfig('controllerNamespace') . ucfirst($controllerName) . "Controller";
        
        if(class_exists($controllerClass)) {
            $controller = new $controllerClass(
                $this->renderer
            //new \app\services\renderers\TwigRenderer()
            );
            try {
                $controller->runAction($actionName);
            } catch (PageNotFoundException $e) {
                echo $e->getMessage();
            }
        }
    }


    public function getConfig($key)
    {
        return $this->config[$key];
    }

    /**
     * @param $name
     * @return mixed
     * @throws \ReflectionException
     */
    public function __get($name)
    {
        if (!isset($this->components[$name])) {
            $this->components[$name] = $this->createComponent($name);
        }
        return $this->components[$name];
    }

    /**
     * @param $name
     * @return object
     * @throws \ReflectionException
     * @throws \Exception
     */
    protected function createComponent($name) //request
    {
        if($params = $this->getConfig('components')[$name]){
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params); 
            }
            throw new \Exception("Не найден класс компонента");
        }
        throw new \Exception("Компонент {$name} не найден");
    }

}