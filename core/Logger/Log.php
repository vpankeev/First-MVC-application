<?php

namespace core\Logger;

class Log
{
    /**
     * @var string
     */
    protected $stream;

    /**
     * Log constructor.
     * @param string $stream
     */
    public function __construct($stream = 'var/log/log.log')
    {
        $this->stream = $stream;
    }

    /**
     * Write message to the log file
     * @param $message
     * @return bool
     */
    public function write($message)
    {
        if (!$this->checkAndCreateFolder($this->stream)) {
            return false;
        }

        $wrapper  = 'Time: ' . date('d.m.Y H:i:s') . PHP_EOL;
        $wrapper .= $message;
        $wrapper .= PHP_EOL . str_repeat('*', 100) . PHP_EOL;

        try {
            $stream = fopen($this->stream, 'a+');
            fwrite($stream, $wrapper);
            fclose($stream);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @param $filename
     * @param int $mode
     * @return bool
     */
    protected function checkAndCreateFolder($filename, $mode = 0777)
    {
        if (empty($this->stream)) {
            return false;
        }
        try {
            $dirname = dirname($filename);

            if (!is_dir($dirname)) {
                $old = umask(0);
                mkdir($dirname, $mode, true);
                umask($old);
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
        return true;
    }
}