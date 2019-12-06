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

namespace Phalcon\DevTools\Mvc\Controller;

use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Manager;
use Phalcon\Config;
use Phalcon\DevTools\Resources\AssetsResource;
use Phalcon\DevTools\Utils\DbUtils;
use Phalcon\DevTools\Utils\FsUtils;
use Phalcon\DevTools\Utils\SystemInfo;
use Phalcon\DevTools\Version;
use Phalcon\Http\Request;
use Phalcon\Http\RequestInterface;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\RouterInterface;
use Phalcon\Mvc\View;
use Phalcon\Registry;
use Phalcon\Url;
use Phalcon\Url\UrlInterface;
use Phalcon\Version as PhVersion;

/**
 * @property Config $config
 * @property FsUtils $fs
 * @property SystemInfo $info
 * @property DbUtils $dbUtils
 * @property Registry $registry
 * @property AssetsResource $resource
 * @property Manager $assets
 * @property Request|RequestInterface $request
 * @property Router|RouterInterface $router
 * @property Response|ResponseInterface $response
 * @property View|View $view
 * @property Url|UrlInterface $url
 */
abstract class Base extends Controller
{
    public function onConstruct()
    {
        $this->setVars()
            ->setCss()
            ->setJs()
            ->setLayout()
            ->initialize();
    }

    abstract public function initialize();

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
            ->addCss(
                $this->resource->path('admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'),
                true,
                false
            )
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
            ->collection('footer')
            ->setTargetPath('js/webtools.js')
            ->setTargetUri('js/webtools.js?v=' . Version::get())
            ->addJs($this->resource->path('admin-lte/plugins/jquery/jquery.min.js'), true, false)
            ->addJs($this->resource->path('admin-lte/plugins/jquery-ui/jquery-ui.min.js'), true, false)
            ->addInlineJs("$.widget.bridge('uibutton', $.ui.button);", false, false)
            ->addJs($this->resource->path('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js'), true, false)
            ->addJs(
                $this->resource->path('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'),
                true,
                false
            )
            ->addJs($this->resource->path('admin-lte/js/adminlte.min.js'), true, false)
            ->addJs($this->resource->path('js/webtools.js'), true, false)
            ->join(true)
            ->addFilter(new Jsmin);

        return $this;
    }

    /**
     * @return $this
     */
    protected function setVars()
    {
        $this->view->setVars(
            [
                'base_uri'        => $this->url->getBaseUri(),
                'webtools_uri'    => rtrim('/', $this->url->getBaseUri()) . '/webtools.php',
                'ptools_version'  => Version::get(),
                'phalcon_version' => PhVersion::get(),
                'phalcon_team'    => 'Phalcon Team',
                'lte_team'        => 'Almsaeed Studio',
                'phalcon_url'     => 'https://phalcon.io/',
                'devtools_url'    => 'https://github.com/phalcon/phalcon-devtools',
                'lte_url'         => 'https://adminlte.io/',
                'app_name'        => 'Phalcon WebTools',
                'app_mini'        => 'PWT',
                'lte_name'        => 'AdminLTE',
                'copy_date'       => '2011-'.date('Y'),
                'lte_date'        => '2014-'.date('Y'),
            ]
        );

        return $this;
    }

    /**
     * Sets the base layout.
     *
     * @return $this
     */
    protected function setLayout()
    {
        $this->view->setLayout('webtools');

        return $this;
    }
}
