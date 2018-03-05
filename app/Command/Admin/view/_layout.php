<?php

/**
 * Layout for templates
 * Better set key like an action in routing.
 */
return [
    'execute' => [
        'header.php' => 'global',
        'navigation.php' => 'global',
        'Command/Admin/view/execute.php' => 'module',
        'footer.php' => 'global'
    ]
];