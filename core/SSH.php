<?php

namespace core;

class SSH
{
    protected $host;
    protected $port;
    protected $user;
    protected $pass;

    public $connection;
    public $authentication;
    public $errors;
    public $stream;

    /**
     * SSH constructor.
     */
    public function __construct()
    {
        $this->getConnection();
    }

    /**
     * Create connection for SSH
     */
    protected function getConnection()
    {
        $settings = \config\SSH::getSettings();

        $this->host = $settings['host'];
        $this->port = $settings['port'];
        $this->user = $settings['user'];
        $this->pass = $settings['pass'];

        $this->connection = ssh2_connect($this->host, $this->port);
        $this->authentication = ssh2_auth_password($this->connection,$this->user,$this->pass);
    }

    /**
     * @param $command
     * @return mixed
     */
    public function exec($command)
    {
        $this->stream = ssh2_exec($this->connection, $command);
        $this->errors = ssh2_fetch_stream($this->stream, SSH2_STREAM_STDERR);

        // Enable blocking for both streams
        stream_set_blocking($this->errors, true);
        stream_set_blocking($this->stream, true);

        $data['output'] = stream_get_contents($this->stream);
        $data['errors'] = stream_get_contents($this->errors);

        // Close the streams
        fclose($this->errors);
        fclose($this->stream);
        return $data;
    }
}