<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

use Phalcon\Builder\Options;

/**
 * ProjectBuilder
 *
 * Abstract Builder to create application skeletons
 *
 * @package     Phalcon\Builder\Project
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
abstract class ProjectBuilder
{
    /**
     * Stores variable values depending on parameters
     * @var array
     */
    protected $variableValues;

    /**
     * Builder options
     * @var Options
     */
    protected $options = null;

    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = array();

    public function __construct(Options $options)
    {
        $this->options = $options;
    }

    /**
     * Build Project
     * @return mixed
     */
    abstract public function build();

    /**
     * Build project directories
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
        $variableValuesResult = array();
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
    protected function generateFile($getFile, $putFile, $name = '')
    {
        if (false == file_exists($putFile)) {
            touch($putFile);
            $fh = fopen($putFile, "w+");

            $str = file_get_contents($getFile);
            if ($name) {
                $str = preg_replace('/@@name@@/', $name, $str);
                $str = preg_replace('/@@namespace@@/', ucfirst($name), $str);
            }

            if (sizeof($this->variableValues) > 0) {
                foreach ($this->variableValues as $variableValueKey => $variableValue) {
                    $variableValueKeyRegEx = '/@@'.preg_quote($variableValueKey, '/').'@@/';
                    $str = preg_replace($variableValueKeyRegEx, $variableValue, $str);
                }
            }

            fwrite($fh, $str);
            fclose($fh);
        }

        return $this;
    }
}
