<?php

namespace Cabinet\Admin\Controller;

use core\Controller;
use NoRoute\Controller\Error404;

class User extends Controller
{
    public function execute()
    {
        $params = $this->getParams();
        $id = !empty($params['id']) ? $params['id'] : null;

        if ($id) {
            /** @var \Cabinet\Admin\Model\User $model */
            $model = $this->getModel();
            $data = $model->getUserData($id);

            $this->getView()->renderLayout($data);
        } else {
            Error404::execute();
        }
    }
}