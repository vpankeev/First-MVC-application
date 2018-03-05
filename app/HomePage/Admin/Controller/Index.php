<?php

namespace HomePage\Admin\Controller;

use core\Controller;

class Index extends Controller
{
    public function execute()
    {
        $this->getModel();
        $this->getView()->renderLayout();
    }
}