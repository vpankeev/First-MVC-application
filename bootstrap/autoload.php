<?php

/** Define constants */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

/** Displaying errors on the screen */
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

/** Autoloader */
spl_autoload_register(function($namespace) {
    $root = ROOT . DS . str_replace('\\', DS, $namespace) . '.php';
    $path = ROOT . DS . 'app' . DS . str_replace('\\', DS, $namespace) . '.php';

    if (file_exists($path)) {
        require_once $path;
    } elseif (file_exists($root)) {
        require_once $root;
    } else {
        \NoRoute\Controller\Error404::execute();
    }
});

/** Run Application */
$app = new bootstrap\App();
$app->run();