<?php

namespace config;

class SSH
{
    protected static $settings = [
        'host' => 'localhost',
        'port' => '22',
        'user' => '',
        'pass' => ''
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