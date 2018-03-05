<?php

namespace Cabinet\Admin\Controller;

use core\Controller;

class Users extends Controller
{
    public function execute()
    {
        /** @var \Cabinet\Admin\Model\Users $model */
        $model = $this->getModel();
        $data['users'] = $model->getUsers();
        $this->getView()->renderLayout($data);
    }
}