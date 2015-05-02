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

namespace Phalcon\Builder;

/**
 * Project
 *
 * Builder to create application skeletons
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
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
                $path = $this->_options['directory'] . DIRECTORY_SEPARATOR;
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

        $type = 'simple';
        if (isset($this->_options['type']) && $type = $this->_options['type']) {
            if (!isset($this->_types[$type])) {
                $keys = array_keys($this->_types);
                $keys = implode(" , ",$keys);
                throw new BuilderException('Type "' . $type . '" is not a valid type. Choose among [' . $keys . '] ');
            }
        }

        $name = null;
        if (isset($this->_options['name']) && $name = $this->_options['name']) {
            $path .= $this->_options['name'] . DIRECTORY_SEPARATOR;

            if (file_exists($path)) {
                throw new BuilderException(sprintf('Directory %s already exists', realpath($path)));
            }

            if (!mkdir($path, 0777, true)) {
                throw new BuilderException(sprintf('Unable create project directory %s', realpath($path)));
            }
        }

        if (!is_writable($path)) {
            throw new BuilderException(sprintf('Directory %s is not writable', realpath($path)));
        }

        $builderClass = $this->_types[$type];

        /** @var \Phalcon\Builder\Project\ProjectBuilder $builder */
        $builder = new $builderClass();

        $success = $builder->build($path, $templatePath, $name, $this->_options);

        if ($success === true) {
            $this->_notifySuccess("Project '$name' was successfully created.");
        }

        return $success;
    }
}
