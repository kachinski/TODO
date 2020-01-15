<?php

namespace app\core;

abstract class Controller
{
    protected $model;
    protected $view;
    protected $host;

    public function __construct($route)
    {
        $this->model = $this->modLoader($route['controller']);
        $this->view = new View($route);
        $this->host = require_once('app/config/host.php');

        if ($this->isSecure())
        {
            $this->host = 'https://' . $this->host;
        }
        else
        {
            $this->host = 'http://' . $this->host;
        }
    }

    private function isSecure()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    }

    private function modLoader($modName)
    {
        $modPath = 'app\models\\' . ucfirst($modName);

        if (class_exists($modPath))
        {
            return new $modPath();
        }
    }
}
