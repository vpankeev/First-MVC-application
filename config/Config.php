<?php

namespace config;

class Config
{
    protected static $settings = [
        /*
        |------------------------------------------------
        | You can use this default data in any template.
        | Example use: echo $this->get('site_name');
        |------------------------------------------------
        */
        'default' => [
            'site_name' => 'test.com',
            'title' => 'Title - test.com',
            'description' => 'Description - test.com',
            'keywords' => 'Keywords - test.com'
        ],
        /*
        |------------------------------------------------
        | Default routes and admin route
        |------------------------------------------------
        */
        'admin_route'    => 'admin8sKzm',
        'default_route'  => 'home',
        'default_action' => 'Index',
        'default_method' => 'execute'
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

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public static function setSetting($key, $value)
    {
        if (empty($key) || empty($value)) {
            return false;
        }
        return self::$settings[$key] = $value;
    }

    /**
     * Add value to array
     * for example, addSetting('default_data', 'admin_name', 'John')
     * For adding an array to method, use method like this:
     *      addSetting('default_data', 'array', ['admin_name' => 'John'])
     * @param $array
     * @param $key
     * @param $value
     * @return bool
     */
    public static function addSetting($array, $key, $value)
    {
        if (empty($key) || empty($value)) {
            return false;
        }

        /** If value is an array, then used foreach statement */
        if ($key == 'array' && is_array($value)) {
            foreach ($value as $k => $v) {
                self::$settings[$array][$k] = $v;
            }
            return true;
        }
        return self::$settings[$array][$key] = $value;
    }
}