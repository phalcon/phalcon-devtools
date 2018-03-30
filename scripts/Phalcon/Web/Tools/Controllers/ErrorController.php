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

use Phalcon\Devtools\Version;
use Phalcon\Mvc\Controller\Base;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

/**
 * \WebTools\Controllers\ErrorController
 *
 * @property \Phalcon\Tag $tag
 * @package WebTools\Controllers
 */
class ErrorController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        parent::initialize();

        $this->view->setLayout('error');
        $this->view->setVars(
            [
                'is_debug' => (ENV_PRODUCTION !== APPLICATION_ENV && ENV_STAGING !== APPLICATION_ENV),
            ]
        );
    }

    /**
     * @Get("/route400", name="error-400")
     */
    public function route400Action()
    {
        $this->tag->prependTitle('Bad Request');
        $this->response->resetHeaders()->setStatusCode(400, null);

        $this->view->setVars(
            [
                'code'         => 400,
                'head_message' => 'Bad Request',
                'message'      => "Sorry! We can't process your request because we believe it is wrong " .
                                 '(request contains incorrect syntax)',
            ]
        );
    }

    /**
     * @Get("/route403", name="error-403")
     */
    public function route403Action()
    {
        $this->tag->prependTitle('Forbidden');
        $this->response->resetHeaders()->setStatusCode(403, null);

        $this->view->setVars(
            [
            'code'         => 403,
            'head_message' => 'Forbidden',
            'message'      => 'Sorry! You are not allowed to access this page.',
            ]
        );
    }

    /**
     * @Get("/route404", name="error-404")
     */
    public function route404Action()
    {
        $this->tag->prependTitle('Not Found');
        $this->response->resetHeaders()->setStatusCode(404, null);

        $this->view->setVars(
            [
                'code'         => 404,
                'head_message' => 'Not Found',
                'message'      => "Sorry! We can't seem to find the page you're looking for.",
            ]
        );
    }

    /**
     * @Get("/route500", name="error-500")
     */
    public function route500Action()
    {
        $this->tag->prependTitle('Internal Server Error');
        $this->response->resetHeaders()->setStatusCode(500, null);

        $this->view->setVars(
            [
                'code'         => 500,
                'head_message' => 'Internal Server Error',
                'message'      => "Sorry! Looks like we're having some server issues.",
            ]
        );
    }

    /**
     * Register CSS assets.
     *
     * @return $this
     */
    protected function setCss()
    {
        $this->assets
            ->collection('main_css')
            ->setTargetPath('css/webtools.css')
            ->setTargetUri('css/webtools.css?v=' . Version::get())
            ->addCss($this->resource->path('bootstrap/css/bootstrap.min.css'), true, false)
            ->addCss($this->resource->path('admin-lte/css/AdminLTE.min.css'))
            ->addCss($this->resource->path('admin-lte/css/skins/_all-skins.min.css'), true, false)
            ->addCss($this->resource->path('css/dashboard.css'))
            ->join(true)
            ->addFilter(new Cssmin);

        return $this;
    }

    /**
     * Register JS assets.
     *
     * @return $this
     */
    protected function setJs()
    {
        $this->assets
            ->collection('js_ie')
            ->setTargetPath('js/webtools-ie.js')
            ->setTargetUri('js/webtools-ie.js?v=' . Version::get())
            ->addJs('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', false, false)
            ->addJs('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', false, false)
            ->join(true)
            ->addFilter(new Jsmin);

        return $this;
    }
}
