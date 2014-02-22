<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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

/**
 * ProjectBuilder
 *
 * Abstract Builder to create application skeletons
 *
 * @category  Phalcon
 * @package   Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
abstract class ProjectBuilder
{
    /* Stores variable values depending on parameters */
    protected $variableValues;

    abstract public function build($name, $path, $templatePath, $options);

    public function buildDirectories(array $directoryList,$path)
    {
        foreach ($directoryList as $dir) {
            @mkdir(rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $dir);
        }
    }

    /**
     * Generate variable values depending on parameters
     *
     * @param $options
     */
    protected function getVariableValues($options) 
    {
        $variableValuesResult = array();
        $variablesJsonFile = $options['templatePath'].'/project/'.$options['type'].'/variables.json';
        if(file_exists($variablesJsonFile)) {
            $variableValues = json_decode(file_get_contents($variablesJsonFile), true);
            if($variableValues) {
              foreach($options as $k => $option) {
                  if(!isset($variableValues[$k])) {
                      continue;
                  }
                  $valueKey = $option ? 'true':'false';
                  $variableValuesResult = $variableValues[$k][$valueKey];
              }
            }
            $this->variableValues = $variableValuesResult;
        }
    }

    /**
    * Generate file $putFile from $getFile, replacing @@variableValues@@
    * @param $getFile
    * @param $putFile
    * @param $name
    */
    protected function generateFile($getFile, $putFile, $name = '') {

       if (file_exists($putFile) == false) {
            $str = file_get_contents($getFile);
            if($name) {
                $str = preg_replace('/@@name@@/', $name, $str);
                $str = preg_replace('/@@namespace@@/', ucfirst($name), $str);
            }
            if(sizeof($this->variableValues) > 0) {
                foreach($this->variableValues as $variableValueKey => $variableValue) {
                    $variableValueKeyRegEx = '/@@'.preg_quote($variableValueKey, '/').'@@/';
                    $str = preg_replace($variableValueKeyRegEx, $variableValue, $str);
                }
            }
            file_put_contents($putFile, $str);
        }

    }
}
