<?php

namespace NoRoute\Controller;

class Error404
{
    public static function execute()
    {
        echo 'Not found! 404 page.';
        die();
    }
}