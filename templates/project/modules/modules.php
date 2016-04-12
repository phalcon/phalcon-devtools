<?php

/**
 * Register application modules
 */
$application->registerModules([
    'frontend' => [
        'className' => '@@namespace@@\Frontend\Module',
        'path' => __DIR__ . '/../apps/frontend/Module.php'
    ]
]);
