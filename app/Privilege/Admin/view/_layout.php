<?php

/**
 * Layout for templates
 * Better set key like an action in routing.
 */
return [
    'give' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Privilege/Admin/view/give.php' => 'module',
        'footer.php' => 'global'
    ],
    'edit' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Privilege/Admin/view/edit.php' => 'module',
        'footer.php' => 'global'
    ],
    'getPrivileges' => [
        'Privilege/Admin/view/getPrivileges.php' => 'module'
    ]
];