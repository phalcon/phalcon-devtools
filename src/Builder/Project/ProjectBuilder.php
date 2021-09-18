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
 * Abstract Builder to create application skeletons
 */
abstract class ProjectBuilder
{
    /**
     * Stores variable values depending on parameters
     *
     * @var array
     */
    protected $variableValues = [];

    /**
     * Builder options
     *
     * @var Config
     */
    protected $options = null;

    /**
     * Project directories
     *
     * @var array
     */
    protected $projectDirectories = [];

    public function __construct(Config $options)
    {
        $this->options = $options;
    }

    /**
     * Build Project
     *
     * @return mixed
     */
    abstract public function build();

    /**
     * Build project directories
     *
     * @return $this
     */
    public function buildDirectories()
    {
        foreach ($this->projectDirectories as $dir) {
            mkdir(realpath($this->options->get('projectPath')) . DIRECTORY_SEPARATOR . $dir, 0777, true);
        }

        return $this;
    }

    /**
     * Generate variable values depending on parameters
     *
     * return $this
     */
    protected function getVariableValues()
    {
        $variableValuesResult = [];
        $variablesJsonFile =
            $this->options->get('templatePath') . DIRECTORY_SEPARATOR
            . 'project' . DIRECTORY_SEPARATOR
            . $this->options->get('type') . DIRECTORY_SEPARATOR .
            'variables.json';

        if (file_exists($variablesJsonFile)) {
            $variableValues = json_decode(file_get_contents($variablesJsonFile), true);
            if ($variableValues) {
                foreach ($this->options as $k => $option) {
                    if (!isset($variableValues[$k])) {
                        continue;
                    }
                    $valueKey = $option ? 'true' : 'false';
                    $variableValuesResult = $variableValues[$k][$valueKey];
                }
            }
            $this->variableValues = $variableValuesResult;
        }

        return $this;
    }

    /**
     * Generate file $putFile from $getFile, replacing @@variableValues@@
     *
     * @param string $getFile From file
     * @param string $putFile To file
     * @param string $name
     *
     * @return $this
     */
    protected function generateFile(string $getFile, string $putFile, string $name = '')
    {
        if (!file_exists($putFile)) {
            touch($putFile);
            $fh = fopen($putFile, 'wb+');

            $str = file_get_contents($getFile);
            if ($name) {
                $namespace = $this->getNamespace();

                $str = preg_replace('/@@name@@/', $name, $str);
                $str = preg_replace('/@@namespace@@/', $namespace, $str);
            }

            if (sizeof($this->variableValues) > 0) {
                foreach ($this->variableValues as $variableValueKey => $variableValue) {
                    $variableValueKeyRegEx = '/@@' . preg_quote($variableValueKey, '/') . '@@/';
                    $str = preg_replace($variableValueKeyRegEx, $variableValue, $str);
                }
            }

            fwrite($fh, $str);
            fclose($fh);
        }

        return $this;
    }

    /**
     * Create .htrouter.php file
     *
     * @param string|null $templatePath
     * @param string|null $projectPath
     *
     * @return $this
     */
    protected function createHtrouterFile(string $projectPath = null, string $templatePath = null)
    {
        if (!$projectPath) {
            $projectPath = $this->options->get('projectPath');
        }

        if (!$templatePath) {
            $templatePath = $this->options->get('templatePath');
        }

        $fromFile = rtrim($templatePath, '\\/') . DIRECTORY_SEPARATOR . '.htrouter.php';
        $toFile = $projectPath . '.htrouter.php';

        $this->generateFile($fromFile, $toFile, $this->options->get('name'));

        return $this;
    }

    protected function getNamespace(string $name = ''): string
    {
        $namespace = $name ? ucfirst($name) : ucfirst($this->options->get('name', ''));
        if (strtolower(trim($name)) === 'default') {
            $namespace = 'MyDefault';
        }

        return $namespace;
    }
}
