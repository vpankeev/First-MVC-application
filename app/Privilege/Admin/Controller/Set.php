<?php

namespace Privilege\Admin\Controller;

use core\Controller;

class Set extends Controller
{
    public function execute()
    {
        /** @var \Privilege\Admin\Model\Set $model */
        $model = $this->getModel();
        $string = $model->getCommandString();

        echo '<pre>' . print_r('Комманда будет отправлена на сервер: ' . $model->getServer($_POST['server']),1) . '</pre>';
        echo '<pre>' . print_r($string,1) . '</pre>';
    }
}