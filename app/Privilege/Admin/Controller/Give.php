<?php

namespace Privilege\Admin\Controller;

use core\Controller;

class Give extends Controller
{
    public function execute()
    {
        /** @var \Privilege\Admin\Model\Give $model */
        $model = $this->getModel();
        $data = $model->getPrivilegeData();

        $this->getView()->renderLayout($data);
    }
}