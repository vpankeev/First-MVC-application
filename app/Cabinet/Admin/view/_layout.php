<?php

/**
 * Layout for templates
 * Better set key like an action in routing.
 */
return [
    'users' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Cabinet/Admin/view/users.php' => 'module',
        'footer.php' => 'global'
    ],
    'user' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Cabinet/Admin/view/user.php' => 'module',
        'footer.php' => 'global'
    ]
];