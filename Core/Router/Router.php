<?php
/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 10/26/2017
 * Time: 2:48 PM
 */

class Router
{

    public static $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static $previous;

    public static $call = [];
    public static $controller = [];
    private static $path;

    public function __construct()
    {
        self::$path = App::root() . "/App/Controllers/";
    }

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, self::$routes[$requestType])) {
            if(isset($_SERVER['HTTP_REFERER']))
            {
                self::$previous=$_SERVER['HTTP_REFERER'];
            }else{
                self::$previous=null;
            }
            if (!strstr(self::$routes[$requestType][$uri], '.php')) {
                if (is_readable(self::$routes[$requestType][$uri] . ".php")) {
                    return self::$routes[$requestType][$uri] . ".php";
                }
                throw new Exception("Controller '" . self::$controller[$uri] . ".php' not Found");
            }
            if (is_readable(self::$routes[$requestType][$uri])) {
                return self::$routes[$requestType][$uri];
            }
            throw new Exception("Controller '" . self::$controller[$uri] . ".php' not Found");
        }
        throw new Exception("Page not found");
    }

    public static function get($uri, $controller)
    {
        if (strstr($controller, '@')) {
            $tmp = explode('@', $controller);
            self::$call[$uri]['GET'] = $tmp[1];
            self::$controller[$uri] = $tmp[0];
            self::$routes['GET'][$uri] = self::$path . $tmp[0];
        }
    }

    public static function post($uri, $controller)
    {
        if (strstr($controller, '@')) {
            $tmp = explode('@', $controller);
            self::$call[$uri]['POST'] = $tmp[1];
            self::$controller[$uri] = $tmp[0];
            self::$routes['POST'][$uri] = self::$path . $tmp[0];
        }
    }
}