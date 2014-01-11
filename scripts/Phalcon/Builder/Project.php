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

namespace Phalcon\Builder;

use Phalcon\Builder;
use Phalcon\Builder\Component;
use Phalcon\Script\Color;

/**
 * Project
 *
 * Builder to create application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Application.php,v 7a54c57f039b 2011/10/19 23:41:19 andres $
 */
class Project extends Component
{

    private $_types = array(
        'micro' => '\Phalcon\Builder\Project\Micro',
        'simple' => '\Phalcon\Builder\Project\Simple',
        'modules' => '\Phalcon\Builder\Project\Modules',
        'cli' => '\Phalcon\Builder\Project\Cli',
    );

    /**
     * Project build
     *
     * @return mixed
     * @throws \Phalcon\Builder\BuilderException
     */
    public function build()
    {

        $path = '';
        if (isset($this->_options['directory'])) {
            if ($this->_options['directory']) {
                $path = $this->_options['directory'] . '/';
            }
        }

        if (isset($this->_options['templatePath'])) {
            $templatePath = $this->_options['templatePath'];
        } else {
            $templatePath = str_replace('scripts/' . str_replace('\\', DIRECTORY_SEPARATOR, __CLASS__) . '.php', '', __FILE__) . 'templates';
        }

        if (file_exists($path.'.phalcon')) {
            throw new BuilderException("Projects cannot be created inside Phalcon projects");
        }

        if (isset($this->_options['type'])) {
            $type = $this->_options['type'];
            if (!isset($this->_types[$type])) {
                $keys = array_keys($this->_types);
                $keys = implode(" , ",$keys);
                throw new BuilderException('Type "' . $type . '" is not a valid type. Choose among [' . $keys . '] ');
            }
        } else {
            $type = 'simple';
        }

        $name = null;
        if (isset($this->_options['name'])) {
            if ($this->_options['name']) {
                $name = $this->_options['name'];
                $path .= $this->_options['name'] . '/';
                if (file_exists($path)) {
                    throw new BuilderException("Directory " . $path . " already exists");
                }

                if (!@mkdir($path)) {
                    throw new BuilderException("Unable to write to '$path'");
                }
            }
        }

        if (!is_writable($path)) {
            throw new BuilderException("Directory " . $path . " is not writable");
        }

        $builderClass = $this->_types[$type];

        $builder = new $builderClass();

        $success = $builder->build($name, $path, $templatePath, $this->_options);

        if ($success===true) {
            $this->_notifySuccess("Project '$name' was successfully created.");
        }

        return $success;
    }

}
