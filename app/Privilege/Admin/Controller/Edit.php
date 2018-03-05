<?php

namespace Privilege\Admin\Controller;

use core\Controller;

class Edit extends Controller
{
    public function execute()
    {
        /** @var \Privilege\Admin\Model\Edit $model */
        $model = $this->getModel();
        $data['privileges'] = $model->getPrivileges();
        $this->getView()->renderLayout($data);
    }
}