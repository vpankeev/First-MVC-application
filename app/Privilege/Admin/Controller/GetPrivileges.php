<?php

namespace Privilege\Admin\Controller;

use core\Controller;
use NoRoute\Controller\Error404;

class GetPrivileges extends Controller
{
    public function execute()
    {
        if (empty($_POST['id'])) {
            die();
        }
        /** @var \Cabinet\Admin\Model\GetPrivileges $model */
        $model = $this->getModel();
        $data['privilege'] = $model->getPrivileges($_POST['id']);
        $this->getView()->renderLayout($data);
    }
}