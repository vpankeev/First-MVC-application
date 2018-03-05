<?php

namespace Auth\Controller;

use core\Controller;

class Register extends Controller
{
    public function execute()
    {
        /** @var \Auth\Model\Register $model */
        $model = $this->getModel();
        $view = $this->getView();

        if (!empty($_POST)) {
            if ($model->insertUser()) {
                $view->loadLayout('success');
            }
        }
        $view->renderLayout();
    }
}