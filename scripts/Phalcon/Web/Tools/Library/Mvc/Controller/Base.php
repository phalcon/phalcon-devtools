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

namespace Phalcon\Web\Tools\Library\Mvc\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

/**
 * \Phalcon\Web\Tools\Library\Mvc\Controller\Base
 *
 * @property \Phalcon\Config config
 *
 * @package Phalcon\Web\Tools\Library\Mvc\Controller
 */
abstract class Base extends Controller
{
    public $pageTitle = '';
    public $pageSubTitle = '';

    public function onConstruct()
    {
        $this->setVars()
            ->setCss()
            ->setJs()
            ->setLayout();

        $this->initialize();
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
            ->setTargetUri('css/webtools.css')
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/bootstrap/css/bootstrap.min.css'), true, false)
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/admin-lte/css/AdminLTE.min.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/admin-lte/css/skins/_all-skins.min.css'), true, false)
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/iCheck/flat/blue.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/morris/morris.min.css'), true, false)
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/jvectormap/jquery-jvectormap-1.2.2.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/datepicker/datepicker3.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/daterangepicker/daterangepicker.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'))
            ->addCss(PTOOLSPATH . str_replace('/', DS, '/resources/css/dashboard.css'))
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
            ->setTargetUri('js/webtools.js')
            ->addJs('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js', false, false)
            ->addInlineJs("$.widget.bridge('uibutton', $.ui.button);", false, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/bootstrap/js/bootstrap.min.js'), true, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/sparkline/jquery.sparkline.min.js'), true, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/jvectormap/jquery-jvectormap-1.2.2.min.js'), true, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/jvectormap/jquery-jvectormap-world-mill-en.js'), true, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/knob/jquery.knob.js'))
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/daterangepicker/daterangepicker.js'))
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/datepicker/bootstrap-datepicker.js'))
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'), false, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/slimScroll/jquery.slimscroll.min.js'), false, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/fastclick/fastclick.min.js'), false, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/admin-lte/js/app.min.js'), true, false)
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/admin-lte/js/pages/dashboard.js'))
            ->addJs(PTOOLSPATH . str_replace('/', DS, '/resources/js/dashboard.js'))
            ->join(true)
            ->addFilter(new Jsmin);

        $this->assets
            ->collection('js_ie')
            ->setTargetPath('js/webtools-ie.js')
            ->setTargetUri('js/webtools-ie.js')
            ->addJs('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', false, false)
            ->addJs('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', false, false)
            ->join(true)
            ->addFilter(new Jsmin);

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
        } else {
            return $this->indexRedirect();
        }
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
                'base_uri'      => $this->url->getBaseUri(),
                'webtools_uri'  => rtrim('/', $this->url->getBaseUri()) . '/webtools.php',
                'phalcon_url'   => 'https://www.phalconphp.com',
                'app_name'      => 'Phalcon WebTools',
                'copy_date'     => '2011-'.date('Y'),
                'page_title'    => $this->pageTitle,
                'page_subtitle' => $this->pageSubTitle,
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
