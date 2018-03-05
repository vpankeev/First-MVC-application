<?php

namespace Command\Admin\Controller;

use core\Controller;

class Execute extends Controller
{
    public function execute()
    {
        $this->getView()->renderLayout();
    }
}