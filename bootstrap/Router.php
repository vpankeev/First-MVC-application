<?php

namespace bootstrap;

use config\Config;
use config\Modules;
use config\Routes;
use NoRoute\Controller\Error404;

class Router
{
    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $route;

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var string
     */
    protected $module;

    /**
     * @var array
     */
    protected $modules = [];

    /**
     * @var string
     */
    protected $moduleFolder;

    /**
     * @var array
     */
    protected $layout;

    /**
     * @var string
     */
    protected $adminRoute;

    /**
     * @var bool
     */
    protected $isAdminPage = false;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->getConfigData();
        $this->parseUri();
    }

    /**
     * Parse REQUEST_URI
     */
    protected function parseUri()
    {
        $uri = urldecode($_SERVER['REQUEST_URI']);

        if (!empty($uri)) {
            $uri = explode('?', $uri);
            $this->uri = trim(current($uri), '/');
            $uriParts  = explode('/', $this->uri);
        }

        /** If uri not empty, then we'll process it */
        if (!empty(current($uriParts))) {

            /** Check admin route */
            if (current($uriParts) == $this->adminRoute) {
                $this->isAdminPage = true;
                array_shift($uriParts);
            }

            if (current($uriParts) && !$this->checkRouteAndModule(strtolower(current($uriParts)))) {
                Error404::execute();
            }

            array_shift($uriParts);

            /** Set action */
            if (current($uriParts)) {
                $this->action = current($uriParts);
                array_shift($uriParts);
            }

            /** Set params */
            if (current($uriParts)) {
                $uriParts = array_chunk($uriParts, 2);
                foreach ($uriParts as $value) {
                    $key = isset($value[0]) ? trim($value[0]) : null;
                    $val = isset($value[1]) ? trim($value[1]) : null;
                    if ($key && $val) {
                        $this->params[$key] = $val;
                    }
                }
            }
        }
        /** Init layout for View in module */
        $this->setLayout();
    }

    /**
     * Get config data from config folder and set it to variables
     */
    protected function getConfigData()
    {
        /** Get main config data */
        $config = Config::getSettings();
        $this->adminRoute   = $config['admin_route'];
        $this->route        = $config['default_route'];
        $this->action       = $config['default_action'];
        $this->method       = $config['default_method'];

        /** Get all routes */
        $this->routes = Routes::getRoutes();

        /** Get all modules */
        $this->modules = Modules::getModules();
        $this->moduleFolder = $this->modules[$this->routes['web'][$this->route]]['folder'];
    }

    /**
     * Check exist route and status of module
     * @param $route
     * @return bool
     */
    protected function checkRouteAndModule($route)
    {
        if ($this->isAdminPage && in_array($route, array_keys($this->routes['admin']))) {
            $this->route  = $route;
            $this->module = $this->routes['admin'][$this->route];
        } elseif (!$this->isAdminPage && in_array($route, array_keys($this->routes['web']))) {
            $this->route  = $route;
            $this->module = $this->routes['web'][$this->route];
        } else {
            return false;
        }

        $module = isset($this->modules[$this->module]) ? $this->modules[$this->module] : null;

        if (!empty($module) && $module['status'] == 1 && !empty($module['folder'])) {
            $this->moduleFolder = $module['folder'];
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array | null
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return array
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @return string
     */
    public function getAdminRoute()
    {
        return $this->adminRoute;
    }

    /**
     * @return bool
     */
    public function isAdminPage()
    {
        return $this->isAdminPage;
    }

    /**
     * @return string
     */
    public function getModuleFolder()
    {
        return $this->moduleFolder;
    }

    /**
     * Set layout to array for using in app
     */
    private function setLayout()
    {
        $path = $this->getPathViewFolder() . '_layout.php';
        if (file_exists($path)) {
            $this->layout = require_once $path;
        }
    }

    /**
     * @return array
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return string
     */
    public function getPathModelFolder()
    {
        $admin = $this->isAdminPage !== false ? 'Admin' . DS : null;
        return ROOT . DS . 'app' . DS . $this->moduleFolder . DS . $admin . 'Model' . DS;
    }

    /**
     * @return string
     */
    public function getPathControllerFolder()
    {
        $admin = $this->isAdminPage !== false ? 'Admin' . DS : null;
        return ROOT . DS . 'app' . DS . $this->moduleFolder . DS . $admin . 'Controller' . DS;
    }

    /**
     * @return string
     */
    public function getPathViewFolder()
    {
        $admin = $this->isAdminPage !== false ? 'Admin' . DS : null;
        return ROOT . DS . 'app' . DS . $this->moduleFolder . DS . $admin . 'view' . DS;
    }

    /**
     * @return string
     */
    public function getPathPubFolder()
    {
        return ROOT . DS . 'pub' . DS;
    }
}