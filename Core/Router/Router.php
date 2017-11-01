<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:48 PM
 */

class Router
{

    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static $call = [];
    public static $controller = [];
    private $path;

    public function __construct()
    {
        $this->path = App::root() . "/App/Controllers/";
    }

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            if (!strstr($this->routes[$requestType][$uri], '.php')) {
                if (is_readable($this->routes[$requestType][$uri] . ".php")) {
                    return $this->routes[$requestType][$uri] . ".php";
                }
                throw new Exception("Controller '{" . self::$controller . ".php}' not Found in '$this->path'");
            }
            if (is_readable($this->routes[$requestType][$uri])) {
                return $this->routes[$requestType][$uri];
            }
            throw new Exception("Controller '{" . self::$controller . ".php}' not Found in '$this->path'");
        }
        throw new Exception("Page not found");
    }

    public function get($uri, $controller)
    {
        if (strstr($controller, '@')) {
            $tmp = explode('@', $controller);
            self::$call[$uri]['GET'] = $tmp[1];
            self::$controller[$uri] = $tmp[0];
            $this->routes['GET'][$uri] = $this->path . $tmp[0];
        }
    }

    public function post($uri, $controller)
    {
        if (strstr($controller, '@')) {
            $tmp = explode('@', $controller);
            self::$call[$uri]['POST'] = $tmp[1];
            self::$controller[$uri] = $tmp[0];
            $this->routes['POST'][$uri] = $this->path . $tmp[0];
        }
    }
}
