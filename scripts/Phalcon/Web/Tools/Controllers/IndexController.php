<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
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

namespace WebTools\Controllers;

use Phalcon\Mvc\Controller\Base;

/**
 * \WebTools\Controllers\IndexController
 *
 * @package WebTools\Controllers
 */
class IndexController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        parent::initialize();

        $this->view->setVar('page_title', 'Dashboard');
    }

    /**
     * @Get("/", name="dashboard")
     */
    public function indexAction()
    {
        $this->view->setVars(
            [
                'page_subtitle' => 'Control panel',
            ]
        );
    }
}
