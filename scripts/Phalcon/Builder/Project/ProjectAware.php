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

namespace Phalcon\Builder\Project;

use Phalcon\Builder\Options;

/**
 * \Phalcon\Builder\Project\ProjectAware
 *
 * @property Options $options
 * @method static generateFile(string $fromFile, string $toFile, string $name = '')
 *
 * @package Phalcon\Builder\Project
 */
trait ProjectAware
{
    /**
     * Create .htrouter.php file
     *
     * @param string $templatePath
     * @param string $projectPath
     *
     * @return $this
     */
    protected function createHtrouterFile($projectPath = null, $templatePath = null)
    {
        if (!$projectPath) {
            $projectPath = $this->options->get('projectPath');
        }

        if (!$templatePath) {
            $templatePath = $this->options->get('templatePath');
        }

        $fromFile = rtrim($templatePath, '\\/') . DIRECTORY_SEPARATOR . '.htrouter.php';
        $toFile   = $projectPath  . '.htrouter.php';

        $this->generateFile($fromFile, $toFile);

        return $this;
    }
}
