<?php

namespace Auth\Controller;

use core\Session;

class Logout
{
    public function execute()
    {
        Session::destroy();
        header('Location: /');
    }
}