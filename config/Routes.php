<?php

namespace config;

class Routes
{
    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    | This array stores all routes used in current Application
    | The key is represented as a route
    | The value is represented as a module
    |
    */
    protected static $routes = [
        /*
         * This array of routes is used for admin panel
         */
        'admin' => [
            'home'      => 'HomePage',
            'cabinet'   => 'Cabinet',
            'privilege' => 'Privilege',
            'command'   => 'Command'
        ],

        /*
         * This array of routes is used for website
         */
        'web' => [
            'home'      => 'HomePage',
            'auth'      => 'Auth',
            'cabinet'   => 'Cabinet',
            'privilege' => 'Privilege'
        ]
    ];

    /**
     * @return array|null
     */
    public static function getRoutes()
    {
        return isset(self::$routes) ? self::$routes : null;
    }

    /**
     * @return mixed|null
     */
    public static function getAdminRoutes()
    {
        return isset(self::$routes['admin']) ? self::$routes['admin'] : null;
    }

    /**
     * @return mixed|null
     */
    public static function getWebRoutes()
    {
        return isset(self::$routes['web']) ? self::$routes['web'] : null;
    }
}