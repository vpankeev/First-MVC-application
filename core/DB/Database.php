<?php

namespace core\DB;

use bootstrap\App;
use core\DB\Delete;
use core\DB\Insert;
use core\DB\Select;
use core\DB\Update;
use core\Logger\Log;

class Database
{
    protected static $connection;

    /**
     * Create mysqli connection and set charset
     * @param $config
     */
    public function create($config)
    {
        self::$connection = new \mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
        self::$connection->set_charset('utf8');
    }

    /**
     * @return Select
     */
    public function select()
    {
        return new Select();
    }

    /**
     * @param string $table
     * @return Update
     */
    public function update($table)
    {
        return new Update($table);
    }

    /**
     * @param string $table
     * @return Delete
     */
    public function delete($table)
    {
        return new Delete($table);
    }

    /**
     * @param string $table
     * @return Insert
     */
    public function insert($table)
    {
        return new Insert($table);
    }

    /**
     * @param $data
     * @return array|string
     */
    public function escape($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = mysqli_real_escape_string(self::$connection, trim($value));
            }
        } else {
            $data = mysqli_real_escape_string(self::$connection, trim($data));
        }

        return $data;
    }

    /**
     * @param string $sql
     * @return bool|\mysqli_result
     */
    public function query($sql)
    {
        $link = self::$connection;

        if (!$result = mysqli_query($link, $sql)) {

            $trace  = debug_backtrace();
            foreach ($trace as $key => $value) {
                if (strpos($value['file'], 'DB') !== false) {
                    unset($trace[$key]);
                }
            }

            $logger = new Log(ROOT . '/var/log/MySQL/' . date('d_m_Y') . '.log');
            $code   = mysqli_errno($link);
            $error  = mysqli_error($link);

            $message  = 'File: ' . current($trace)['file'] . PHP_EOL;
            $message .= 'Line: ' . current($trace)['line'] . PHP_EOL;
            $message .= 'IP info | ' . App::getUserIp() . PHP_EOL;
            $message .= 'Query: ' . $sql . PHP_EOL;
            $message .= 'Code: ' . $code . PHP_EOL;
            $message .= 'Error: ' . $error . PHP_EOL;

            $logger->write($message);
        }
        return $result;
    }
}