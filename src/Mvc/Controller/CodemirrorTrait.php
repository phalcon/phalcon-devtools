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
use Phalcon\DevTools\Resources\AssetsResource;
use Phalcon\DevTools\Version;

/**
 * @property Manager $assets
 * @property AssetsResource $resource
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
