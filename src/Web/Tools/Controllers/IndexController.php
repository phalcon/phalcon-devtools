<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Web\Tools\Controllers;

use Phalcon\DevTools\Mvc\Controller\Base;

class IndexController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setVar('page_title', 'Dashboard');
    }

    /**
     * @Get("/", name="dashboard")
     */
    public function indexAction(): void
    {
        // Nothing here
    }
}
