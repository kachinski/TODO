<?php

namespace app\core;

class View
{
    private $routePath;

    public function __construct($route)
    {
        $this->routePath = $route['controller'] . '/' . $route['action'];
    }

    public function render($vars = [])
    {
        // array values to variables
        extract($vars);

        // buffering
        ob_start();

        // main content
        require_once 'app/views/' . $this->routePath . '.php';

        // get the contents of the current buffer and delete it
        $content = ob_get_clean();

        // layout
        require_once 'app/views/layouts/default.php';
    }

    public static function msg($vars, $code = 200)
    {
        http_response_code($code);
        extract($vars);
        ob_start();
        require_once 'app/views/misc/msg.php';
        $content = ob_get_clean();
        require_once 'app/views/layouts/default.php';

        die;
    }
}
