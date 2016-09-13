<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Elements\Menu;

use Phalcon\Elements\Element;

/**
 * \Phalcon\Elements\Menu\SidebarMenu
 *
 * @package Phalcon\Elements\Menu
 */
class SidebarMenu extends Element
{
    protected $menuItems = [
        'sidebar-menu' => [
            'items' => [
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
                                    'href' => '/webtools.php?_url=/controllers/create',
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
                                    'href' => '/webtools.php?_url=/models/create',
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
                                    'href' => '/webtools.php?_url=/scaffold/create',
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
                                    'href' => '/webtools.php?_url=/migrations/create',
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
                                    'icon' => 'fa fa-reorder',
                                ],
                            ],
                        ],
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
                        'text'  => 'Phalcon DevTools',
                    ],
                ],

                // Incubator
                [
                    'link'  => [
                        'href'  => 'https://github.com/phalcon/incubator',
                        'icon'  => 'fa fa-book',
                        'text'  => 'Incubator',
                    ],
                ],

                // Phalcon Docs
                [
                    'link'  => [
                        'href'  => 'http://docs.phalconphp.com/',
                        'icon'  => 'fa fa-book',
                        'text'  => 'Phalcon Docs',
                    ],
                ],

                // Zephir
                [
                    'link'  => [
                        'href'  => 'http://zephir-lang.com/',
                        'icon'  => 'fa fa-book',
                        'text'  => 'Zephir',
                    ],
                ],

                // Awesome Phalcon
                [
                    'link'  => [
                        'href'  => 'https://github.com/sergeyklay/awesome-phalcon',
                        'icon'  => 'fa fa-book',
                        'text'  => 'Awesome Phalcon',
                    ],
                ],
            ],
        ],
    ];

    protected function renderItems($items)
    {
        if (empty($items) || !is_array($items)) {
            return '';
        }

        $html = '';

        foreach ($items as $item) {
            $html .= sprintf('<li class="%s">', (isset($item['class']) ? $item['class'] : ''));

            if (isset($item['text'])) {
                $html .= $item['text'];
            }

            if (isset($item['link'])) {
                $html .= $this->createLink($item['link']);
            }

            if (isset($item['submenu']) && is_array($item['submenu'])) {
                $submenu = $item['submenu'];
                if (isset($submenu['link'])) {
                    $html .= $this->createLink($submenu['link']);
                }

                $class = isset($submenu['class']) ? $submenu['class'] : '';
                $html .= sprintf('<ul class="%s">', $class);

                if (isset($submenu['items']) && is_array($submenu['items'])) {
                    $html .= $this->renderItems($submenu['items']);
                }

                $html .= '</ul>';
            }

            $html .= '</li>';
        }


        return $html;
    }

    public function render()
    {
        $menu = '';

        foreach ($this->menuItems as $className => $menuData) {
            $menu .= sprintf('<ul class="%s">', $className);
            $menu .= $this->renderItems($menuData['items']);
            $menu .= '</ul>';
        }

        return $menu;
    }
}
