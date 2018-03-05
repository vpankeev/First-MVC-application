<?php

/**
 * Layout for templates
 * Better set key like an action in routing.
 */
return [
    'register' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Auth/view/register.php' => 'module',
        'footer.php' => 'global'
    ],

    'success' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Auth/view/registerComplete.php' => 'module',
        'footer.php' => 'global'
    ]
];