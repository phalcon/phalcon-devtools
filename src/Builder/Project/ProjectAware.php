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

namespace Phalcon\DevTools\Builder\Project;

use Phalcon\Config;

/**
 * @property Config $options
 * @method static generateFile(string $fromFile, string $toFile, string $name = '')
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
        $toFile = $projectPath . '.htrouter.php';

        $this->generateFile($fromFile, $toFile);

        return $this;
    }
}
