<?php

namespace config;

class Modules
{
    /*
    |--------------------------------------------------------------------------
    | Modules
    |--------------------------------------------------------------------------
    | This array stores all modules used in current Application
    | The key is represented as a name of module and is used for routes
    | The value consists of two parts: status and folder
    |   `status` can be an active - `1` and an inactive - `0`
    |   `folder` contains all logic of module and located in `app` folder
    |
    */
    protected static $modules = [
        'HomePage'  => ['status' => '1', 'folder' => 'HomePage'],
        'Auth'      => ['status' => '1', 'folder' => 'Auth'],
        'Cabinet'   => ['status' => '1', 'folder' => 'Cabinet'],
        'Privilege' => ['status' => '1', 'folder' => 'Privilege'],
        'Command'   => ['status' => '1', 'folder' => 'Command']
    ];

    /**
     * @return array|null
     */
    public static function getModules()
    {
        return !empty(self::$modules) ? self::$modules : null;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function getModule($key)
    {
        return isset(self::$modules[$key]) ? self::$modules[$key] : null;
    }
}