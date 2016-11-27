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

use Phalcon\Devtools\Version;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

/**
 * \Phalcon\Mvc\Controller\CodemirrorTrait
 *
 * @property \Phalcon\Assets\Manager $assets
 * @property \Phalcon\Resources\AssetsResource $resource
 *
 * @package Phalcon\Mvc\Controller
 */
trait CodemirrorTrait
{
    protected function registerResources()
    {
        $this->assets
            ->collection('custom_css')
            ->setTargetPath('css/codemirror.css')
            ->setTargetUri('css/codemirror.css?v=' . Version::get())
            ->addCss($this->resource->path('codemirror/theme/ambiance.css'))
            ->addCss($this->resource->path('codemirror/lib/codemirror.css'))
            ->addCss($this->resource->path('codemirror/lib/codephalcon.css'))
            ->join(true)
            ->addFilter(new Cssmin);

        $this->assets
            ->collection('codemirror')
            ->setTargetPath('js/codemirror.js')
            ->setTargetUri('js/codemirror.js?v=' . Version::get())
            ->addJs($this->resource->path('codemirror/lib/codemirror.js'))
            ->addJs($this->resource->path('codemirror/addon/edit/matchbrackets.js'))
            ->addJs($this->resource->path('codemirror/addon/selection/active-line.js'))
            ->addJs($this->resource->path('codemirror/mode/clike/clike.js'))
            ->addJs($this->resource->path('codemirror/mode/htmlmixed/htmlmixed.js'))
            ->addJs($this->resource->path('codemirror/mode/xml/xml.js'))
            ->addJs($this->resource->path('codemirror/mode/css/css.js'))
            ->addJs($this->resource->path('codemirror/mode/php/php.js'))
            ->addJs($this->resource->path('codemirror/lib/codephalcon.js'))
            ->join(true)
            ->addFilter(new Jsmin);
    }
}
