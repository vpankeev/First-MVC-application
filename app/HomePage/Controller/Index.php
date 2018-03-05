<?php

namespace HomePage\Controller;

use core\Controller;

class Index extends Controller
{
    public function execute()
    {
        /** @var \HomePage\Model\Index $model */
        $model = $this->getModel();
        $model->getUserData();
        $this->getView()->renderLayout($model->getData());
    }
}