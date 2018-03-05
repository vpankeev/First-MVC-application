<?php

namespace core;

class Session
{
    /** @var array */
    protected static $messages;

    /**
     * @param $key
     * @return bool|mixed
     */
    public static function getMessage($key)
    {
        if (isset(self::$messages[$key])) {
            return self::$messages[$key];
        }
        return false;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public static function setMessage($key, $value)
    {
        if (!empty($key) && !empty($value)) {
            self::$messages[$key] = $value;
            return true;
        }
        return false;
    }

    /**
     * Set value for $_SESSION
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get value from $_SESSION
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Delete value from $_SESSION
     * @param $key
     */
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy session
     */
    public static function destroy()
    {
        session_destroy();
    }
}