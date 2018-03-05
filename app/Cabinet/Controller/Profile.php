<?php

namespace Cabinet\Controller;

use core\Controller;
use NoRoute\Controller\Error404;

class Profile extends Controller
{
    public function execute()
    {
        /** @var \Cabinet\Model\Profile $model */
        $model = $this->getModel();
        $user = $model->getUserData();

        if (empty($user['entity_id'])) {
            Error404::execute();
        }
        if (!empty($_POST)) {
            $model->save();
        }

        $this->getView()->renderLayout();
    }
}