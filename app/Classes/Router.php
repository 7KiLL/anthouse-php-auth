<?php

namespace App\Classes;

class Router
{

    private static $instance = null;
    private $routes = [];

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): self
    {
        require_once '../routes/web.php';

        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    private function __wakeup()
    {
    }


    /**
     * @param string $url
     * @param \Closure|string $callback
     * @return $this
     */
    public function addRoute(string $url, $callback)
    {
        $this->routes[$url] = $callback;
        return $this;
    }

    public function getRoute(string $route, $renderer, $request)
    {
        if (isset($this->routes[$route]))
            if ($this->routes[$route] instanceof \Closure) {
                return $this->routes[$route]($renderer, $request);
            } else {
                $fqcn = preg_split('#@#', $this->routes[$route]);
                return call_user_func([$fqcn[0], $fqcn[1]], $renderer, $request);
            }
        echo (new Renderer())->render('error', []);
        exit();
    }
}
