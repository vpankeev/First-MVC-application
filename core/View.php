<?php

namespace core;

use bootstrap\App;
use config\Config;
use NoRoute\Controller\Error404;

class View
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array|null
     */
    protected $layout;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->setDefaultData();
        if ($this->layout ===  null) {
            $this->loadLayout();
        }
    }

    /**
     * Load layout to array $this->layout
     * @param null|string $name
     */
    public function loadLayout($name = null)
    {
        if ($name === null) {
            $name = App::getRouter()->getAction();
        }

        $layout = App::getRouter()->getLayout();
        $this->layout = !empty($layout[$name]) ? $layout[$name] : null;
    }

    /**
     * This method helps to get data in the view
     * @param $key
     * @param $array
     * @return bool|mixed
     */
    protected function get($key, $array = null)
    {
        if ($array) {
            return isset($this->data[$array][$key]) ? $this->data[$array][$key] : false;
        }
        return isset($this->data[$key]) ? $this->data[$key] : false;
    }

    /**
     * Rendering page from templates
     * Templates are listed in the _layout.php
     * @param array $data
     */
    public function renderLayout($data = [])
    {
        /** If load incorrect layout, get 404 page */
        if ($this->layout === null || !is_array($this->layout)) {
            Error404::execute();
        }

        /** Set data received from model */
        $this->data = !empty($data) ? array_merge($this->data, $data) : $this->data;

        /** Turn on output buffering */
        ob_start();

        /**
         * foreach layout and include exist template files.
         */
        foreach ($this->layout as $path => $type) {
            if ($type == 'global') {
                $path = ROOT . DS . 'pub' . DS . 'templates' . DS . $path;
            } elseif ($type == 'module') {
                $path = ROOT . DS . 'app' . DS . str_replace('/', DS, $path);
            } else {
                continue;
            }

            if (file_exists($path)) {
                require_once $path;
            }
        }

        /** Return the contents of the output buffer */
        $content = ob_get_contents();

        /** Flush (send) the output buffer and turn off output buffering */
        ob_end_clean();

        echo $content;
    }

    /**
     * @return array|null
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * This is opportunity for include child template in
     * general layout templates
     * Use in template: $this->getTemplate('example.php');
     * @param $name
     * @return bool
     */
    protected function getTemplate($name)
    {
        if (is_string($name) || !empty($name)) {
            $path = App::getRouter()->getPathViewFolder() . $name;
            if (file_exists($path)) {
                require_once $path;
            }
        }
        return false;
    }

    /**
     * This is opportunity for include child template in
     * general layout templates from pub folder
     * Use in template: $this->getGlobalTemplate('example.php');
     * @param $name
     * @return bool
     */
    protected function getGlobalTemplate($name)
    {
        if (is_string($name) || !empty($name)) {
            $path = App::getRouter()->getPathPubFolder() . 'templates' . DS . $name;
            if (file_exists($path)) {
                require_once $path;
            }
        }
        return false;
    }

    /**
     * Set default data from General config - config/Config.php
     */
    protected function setDefaultData()
    {
        $this->data = Config::getSettings();
    }

    /**
     * Check active page
     * @param $link
     * @return bool|string
     */
    protected function checkActivePage($link)
    {
        $action = App::getRouter()->getAction();
        $active = false;

        if (($action == $link) || (empty($link) && $action == 'Index')) {
            $active = 'class="active"';
        }
        return $active;
    }

    /**
     * Generate admin url
     * @param $path
     * @return string
     */
    protected function getAdminUrl($path)
    {
        return '/' . $this->get('admin_route') . '/' . $path;
    }
}