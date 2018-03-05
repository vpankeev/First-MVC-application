<?php

namespace core;

use bootstrap\App;
use core\View;

class Controller
{
    /**
     * @return object|false
     */
    protected function getModel()
    {
        $namespace = str_replace('Controller', 'Model', get_class($this));
        $path = ROOT . DS . 'app' . DS . str_replace('\\', DS, $namespace) . '.php';

        return file_exists($path) ? new $namespace : false;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return new View();
    }

    /**
     * @return array|null
     */
    public function getParams()
    {
        return App::getRouter()->getParams();
    }
}