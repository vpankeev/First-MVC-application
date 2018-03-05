<?php

namespace HomePage\Model;

use core\Model;
use \core\Session;

class Index extends Model
{
    public function getUserData()
    {
        $data = Session::get('user');
    }
}