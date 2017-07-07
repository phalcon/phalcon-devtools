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

namespace Phalcon\Mvc\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Devtools\Version;
use Phalcon\Version as PhVersion;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

/**
 * \Phalcon\Mvc\Controller\Base
 *
 * @property \Phalcon\Config $config
 * @property \Phalcon\Utils\FsUtils $fs
 * @property \Phalcon\Utils\SystemInfo $info
 * @property \Phalcon\Utils\DbUtils $dbUtils
 * @property \Phalcon\Registry $registry
 * @property \Phalcon\Elements\Menu\SidebarMenu $sidebar
 * @property \Phalcon\Resources\AssetsResource $resource
 *
 * @package Phalcon\Mvc\Controller
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

    /**
     * Override this method to provide custom behavior.
     */
    public function initialize()
    {
        // nothing
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
            ->addCss($this->resource->path('jvectormap/jquery-jvectormap-1.2.2.css'))
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
            ->collection('footer')
            ->setTargetPath('js/webtools.js')
            ->setTargetUri('js/webtools.js?v=' . Version::get())
            ->addJs($this->resource->path('jquery/2.2.4/jquery.min.js'), true, false)
            ->addJs($this->resource->path('jquery-ui/jquery-ui.min.js'), true, false)
            ->addInlineJs("$.widget.bridge('uibutton', $.ui.button);", false, false)
            ->addJs($this->resource->path('bootstrap/js/bootstrap.min.js'), true, false)
            ->addJs($this->resource->path('sparkline/jquery.sparkline.min.js'), true, false)
            ->addJs($this->resource->path('jvectormap/jquery-jvectormap-1.2.2.min.js'), true, false)
            ->addJs($this->resource->path('jvectormap/jquery-jvectormap-world-mill-en.js'), true, false)
            ->addJs($this->resource->path('slimScroll/jquery.slimscroll.min.js'), false, false)
            ->addJs($this->resource->path('fastclick/fastclick.min.js'), false, false)
            ->addJs($this->resource->path('admin-lte/js/app.min.js'), true, false)
            ->addJs($this->resource->path('js/dashboard.js'))
            ->join(true)
            ->addFilter(new Jsmin);

        $this->assets
            ->collection('js_ie')
            ->addJs('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', false, false)
            ->addJs('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', false, false);

        return $this;
    }

    /**
     * Returns to the WebTools
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    protected function webtoolsRedirect()
    {
        $referer = $this->request->getHTTPReferer();
        if ($path = parse_url($referer, PHP_URL_PATH)) {
            $this->router->handle($path);
            return $this->router->wasMatched() ? $this->response->redirect($path, true) : $this->indexRedirect();
        }

        return $this->indexRedirect();
    }

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    protected function indexRedirect()
    {
        return $this->response->redirect('/');
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
                'phalcon_url'     => 'https://www.phalconphp.com',
                'devtools_url'    => 'https://github.com/phalcon/phalcon-devtools',
                'lte_url'         => 'http://almsaeedstudio.com',
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
