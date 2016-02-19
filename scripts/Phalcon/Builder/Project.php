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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder;

/**
 * Project Builder
 *
 * Builder to create application skeletons
 *
 * @package  Phalcon\Builder
 */
class Project extends Component
{
    CONST TYPE_MICRO   = 'micro';
    CONST TYPE_SIMPLE  = 'simple';
    CONST TYPE_MODULES = 'modules';
    CONST TYPE_CLI     = 'cli';

    /**
     * Current Project Type
     * @var null
     */
    private $currentType = self::TYPE_SIMPLE;

    /**
     * Available Project Types
     * @var array
     */
    private $_types = array(
        self::TYPE_MICRO   => '\Phalcon\Builder\Project\Micro',
        self::TYPE_SIMPLE  => '\Phalcon\Builder\Project\Simple',
        self::TYPE_MODULES => '\Phalcon\Builder\Project\Modules',
        self::TYPE_CLI     => '\Phalcon\Builder\Project\Cli',
    );

    /**
     * Project build
     *
     * @return mixed
     * @throws \Phalcon\Builder\BuilderException
     */
    public function build()
    {
        if ($this->options->contains('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $templatePath = str_replace('scripts/' . str_replace('\\', DIRECTORY_SEPARATOR, __CLASS__) . '.php', '', __FILE__) . 'templates';
        if ($this->options->contains('templatePath')) {
            $templatePath = $this->options->get('templatePath');
        }

        if ($this->path->hasPhalconDir()) {
            throw new BuilderException('Projects cannot be created inside Phalcon projects.');
        }

        $this->currentType = $this->options->get('type');

        if (!isset($this->_types[$this->currentType])) {
            throw new BuilderException(sprintf(
                'Type "%s" is not a valid type. Choose among [%s] ',
                $this->currentType,
                implode(', ', array_keys($this->_types))
            ));
        }

        $builderClass = $this->_types[$this->currentType];

        if ($this->options->contains('name')) {
            $this->path->appendRootPath($this->options->get('name'));
        }

        if (file_exists($this->path->getRootPath())) {
            throw new BuilderException(sprintf('Directory %s already exists.', $this->path->getRootPath()));
        }

        if (!mkdir($this->path->getRootPath(), 0777, true)) {
            throw new BuilderException(sprintf('Unable create project directory %s', $this->path->getRootPath()));
        }

        if (!is_writable($this->path->getRootPath())) {
            throw new BuilderException(sprintf('Directory %s is not writable.', $this->path->getRootPath()));
        }

        $this->options->offsetSet('templatePath', $templatePath);
        $this->options->offsetSet('projectPath', $this->path->getRootPath());

        /** @var \Phalcon\Builder\Project\ProjectBuilder $builder */
        $builder = new $builderClass($this->options);

        $success = $builder->build();

        if ($success === true) {
            $this->_notifySuccess(sprintf(
                'Project "%s" was successfully created.',
                $this->options->get('name')
            ));
        }

        return $success;
    }
}
