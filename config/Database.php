<?php

namespace config;

class Database
{
    protected static $settings = [
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => 'root',
        'db_name' => 'deadly'
    ];

    /**
     * @return array|null
     */
    public static function getSettings()
    {
        return !empty(self::$settings) ? self::$settings : null;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function getSetting($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }
}