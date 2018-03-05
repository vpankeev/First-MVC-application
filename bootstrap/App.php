<?php

namespace bootstrap;

use bootstrap\Router;
use NoRoute\Controller\Error404;

class App
{
    /** Constants for check user ip */
    const SERVER_IP = [
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];

    /**
     * @var Router
     */
    protected static $router;

    /**
     * App constructor.
     */
    public function __construct()
    {
        self::$router = new Router();
    }

    /**
     * Run the application
     * @return bool
     */
    public function run()
    {
        $folder = ucfirst(self::$router->getModuleFolder());
        $action = ucfirst(self::$router->getAction());
        $method = strtolower(self::$router->getMethod());

        if (self::$router->isAdminPage()) {
            $objectPath = DS . $folder . '/Admin/Controller/' . $action;
        } else {
            $objectPath = DS . $folder . '/Controller/' . $action;
        }
        $objectPath = str_replace('/', '\\', $objectPath);

        if (method_exists($objectPath, $method)) {
            try {
                $object = new $objectPath;
                $object->$method();
            } catch (\Exception $e) {
                echo $e->getMessage() . '<br/>';
                echo print_r($e->getTraceAsString(),true);
            }
        } else {
            Error404::execute();
        }
        return true;
    }

    /**
     * @return Router
     */
    public static function getRouter()
    {
        return !empty(self::$router) ? self::$router : null;
    }

    /**
     * Get user ip address
     * @return string
     */
    public static function getUserIp()
    {
        foreach (self::SERVER_IP as $item) {
            if (empty($_SERVER[$item]) || !filter_var($_SERVER[$item], FILTER_VALIDATE_IP)) {
                continue;
            }
            $ips[] = $item . ': [ ' . $_SERVER[$item] . ' ]';
        }
        return empty($ips) ? 'Unknown ip-address' : implode(', ', $ips);
    }
}