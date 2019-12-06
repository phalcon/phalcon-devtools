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

use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\DevTools\Mvc\Controller\Base;
use Phalcon\DevTools\Version;
use Phalcon\Tag;

/**
 * @property Tag $tag
 */
class ErrorController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setLayout('error');
        $this->view->setVars(
            [
                'is_debug' => !in_array(APPLICATION_ENV, [ENV_PRODUCTION, ENV_STAGING]),
            ]
        );
    }

    /**
     * @Get("/route400", name="error-400")
     */
    public function route400Action(): void
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
    public function route403Action(): void
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
    public function route404Action(): void
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
    public function route500Action(): void
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
            ->addCss($this->resource->path('admin-lte/css/adminlte.min.css'), true, false)
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
            ->addJs($this->resource->path('admin-lte/plugins/jquery/jquery.min.js'), true, false)
            ->addJs($this->resource->path('admin-lte/plugins/jquery-ui/jquery-ui.min.js'), true, false)
            ->addInlineJs("$.widget.bridge('uibutton', $.ui.button);", false, false)
            ->addJs($this->resource->path('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'), true, false)
            ->addJs($this->resource->path('admin-lte/js/adminlte.min.js'), true, false)
            ->addJs($this->resource->path('js/webtools.js'), true, false)
            ->join(true)
            ->addFilter(new Jsmin);

        return $this;
    }
}
