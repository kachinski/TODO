<?php

namespace app\core;

class Router
{
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $arr = require_once 'app/config/routes.php';

        foreach ($arr as $route => $params)
        {
            $this->routes[$route] = $params;
        }
    }

    private function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $key => $params)
        {
            // govnocode is below))) i know...
            $routeRegex = '/^(' . str_replace('/', '\/', $key) . ')(\?{1}[^\?\/]+)?$/';

            if (preg_match($routeRegex, $url))
            {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match())
        {
            $controllerPath = 'app\controllers\\' . ucfirst($this->params['controller']);

            if (class_exists($controllerPath))
            {
                $action = $this->params['action'];

                if (method_exists($controllerPath, $action))
                {
                    $controller = new $controllerPath($this->params);
                    $controller->$action();
                }
                else
                {
                    View::msg([
                        'title' => 'Forbidden',
                        'button_text' => 'Go to TODO list',
                        'button_link' => '/todo/list'
                    ], 403);
                }
            }
            else
            {
                View::msg([
                    'title' => 'Forbidden',
                    'button_text' => 'Go to TODO list',
                    'button_link' => '/todo/list'
                ], 403);
            }
        }
        else
        {
            View::msg([
                'title' => 'Forbidden',
                'button_text' => 'Go to TODO list',
                'button_link' => '/todo/list'
            ], 403);
        }
    }
}
