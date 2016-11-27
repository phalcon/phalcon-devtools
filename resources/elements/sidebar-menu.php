<?php

return [
    'sidebar-menu' => [
        // Header
        [
            'class' => 'header',
            'text'  => 'MAIN NAVIGATION',
        ],

        // Home
        [
            'link'  => [
                'href'  => '/webtools.php?_url=/',
                'icon'  => 'fa fa-dashboard',
                'text'  => 'Home',
                'wrap'  => 'span',
            ],
        ],

        // Controllers
        [
            'class'   => 'treeview',
            'submenu' => [
                'link'  => [
                    'href'  => '/webtools.php?_url=/controllers',
                    'icon'  => 'fa fa-cubes',
                    'text'  => 'Controllers',
                    'wrap'  => 'span',
                    'caret' => 'fa fa-angle-left pull-right',
                ],
                'class' => 'treeview-menu',
                'items' => [
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/controllers/generate',
                            'text' => 'Generate',
                            'wrap' => 'span',
                            'icon' => 'fa fa-plus',
                        ],
                    ],
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/controllers/list',
                            'text' => 'List all',
                            'wrap' => 'span',
                            'icon' => 'fa fa-reorder',
                        ],
                    ],
                ],
            ],
        ],

        // Models
        [
            'class'   => 'treeview',
            'submenu' => [
                'link'  => [
                    'href'  => '/webtools.php?_url=/models',
                    'icon'  => 'fa fa-database',
                    'text'  => 'Models',
                    'wrap'  => 'span',
                    'caret' => 'fa fa-angle-left pull-right',
                ],
                'class' => 'treeview-menu',
                'items' => [
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/models/generate',
                            'text' => 'Generate',
                            'wrap' => 'span',
                            'icon' => 'fa fa-plus',
                        ],
                    ],
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/models/list',
                            'text' => 'List all',
                            'wrap' => 'span',
                            'icon' => 'fa fa-reorder',
                        ],
                    ],
                ],
            ],
        ],

        // Scaffold
        [
            'class'   => 'treeview',
            'submenu' => [
                'link'  => [
                    'href'  => '/webtools.php?_url=/scaffold',
                    'icon'  => 'fa fa-file-code-o',
                    'text'  => 'Scaffold',
                    'wrap'  => 'span',
                    'caret' => 'fa fa-angle-left pull-right',
                ],
                'class' => 'treeview-menu',
                'items' => [
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/scaffold/generate',
                            'text' => 'Generate',
                            'wrap' => 'span',
                            'icon' => 'fa fa-plus',
                        ],
                    ],
                ],
            ],
        ],

        // Migrations
        [
            'class'   => 'treeview',
            'submenu' => [
                'link'  => [
                    'href'  => '/webtools.php?_url=/migrations',
                    'icon'  => 'fa fa-magic',
                    'text'  => 'Migrations',
                    'wrap'  => 'span',
                    'caret' => 'fa fa-angle-left pull-right',
                ],
                'class' => 'treeview-menu',
                'items' => [
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/migrations/generate',
                            'text' => 'Generate',
                            'wrap' => 'span',
                            'icon' => 'fa fa-plus',
                        ],
                    ],
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/migrations/list',
                            'text' => 'List all',
                            'wrap' => 'span',
                            'icon' => 'fa fa-reorder',
                        ],
                    ],
                    [
                        'link'  => [
                            'href' => '/webtools.php?_url=/migrations/run',
                            'text' => 'Run',
                            'wrap' => 'span',
                            'icon' => 'fa fa-play',
                        ],
                    ],
                ],
            ],
        ],

        // System Info
        [
            'link'  => [
                'href'  => '/webtools.php?_url=/info',
                'icon'  => 'fa fa-info',
                'text'  => 'System Info',
                'wrap'  => 'span',
            ],
        ],

        [
            'class' => 'header',
            'text'  => 'LINKS',
        ],

        // DevTools
        [
            'link'  => [
                'href'  => 'https://github.com/phalcon/phalcon-devtools',
                'icon'  => 'fa fa-book',
                'local' => false,
                'target' => '_blank',
                'text'  => 'Phalcon DevTools',
                'wrap'  => 'span',
            ],
        ],

        // Incubator
        [
            'link'  => [
                'href'  => 'https://github.com/phalcon/incubator',
                'icon'  => 'fa fa-book',
                'local' => false,
                'target' => '_blank',
                'text'  => 'Phalcon Incubator',
                'wrap'  => 'span',
            ],
        ],

        // Phalcon Docs
        [
            'link'  => [
                'href'  => 'http://docs.phalconphp.com/',
                'icon'  => 'fa fa-book',
                'local' => false,
                'target' => '_blank',
                'text'  => 'Phalcon Docs',
                'wrap'  => 'span',
            ],
        ],

        // Zephir
        [
            'link'  => [
                'href'  => 'https://zephir-lang.com/',
                'icon'  => 'fa fa-book',
                'local' => false,
                'target' => '_blank',
                'text'  => 'Zephir',
                'wrap'  => 'span',
            ],
        ],

        // Awesome Phalcon
        [
            'link'  => [
                'href'  => 'https://github.com/sergeyklay/awesome-phalcon',
                'icon'  => 'fa fa-book',
                'local' => false,
                'target' => '_blank',
                'text'  => 'Awesome Phalcon',
                'wrap'  => 'span',
            ],
        ],
    ],
];
