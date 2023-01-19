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

namespace Phalcon\DevTools\Builder\Component;

use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Generator\AbstractEntityGenerator;
use Phalcon\DevTools\Generator\Entity\ControllerEntityGenerator;
use Phalcon\DevTools\Utils;

/**
 * Builder to generate task
 */
class Task extends AbstractComponent
{
    /**
     * Create Builder object
     *
     * @param array $options Builder options
     * @throws BuilderException
     */
    public function __construct(array $options = [])
    {
        if (!isset($options['name'])) {
            throw new BuilderException('Please specify the task name.');
        }

        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        if (!isset($options['suffix'])) {
            $options['suffix'] = 'Task';
        }

        parent::__construct($options);
    }

    /**
     * @throws BuilderException
     */
    public function build(array $actions = []): self
    {
        if (!$this->options->has('name')) {
            throw new BuilderException('The task name is required.');
        }

        $name = str_replace(' ', '_', $this->options->get('name'));
        $baseClass = $this->options->get('baseClass');
        $namespace = $this->constructNamespace();
        $className = Utils::camelize($name) . $this->options->get('suffix');

        $this->generator = new ControllerEntityGenerator($className, $baseClass, $namespace);
        $this->generator->setStrict();
        $this->generator->addMethods($actions);

        return $this;
    }

    /**
     * @throws BuilderException
     */
    public function write(array $actions = []): string
    {
        if (null === $this->generator) {
            $this->build($actions);
        }

        $name = str_replace(' ', '_', $this->options->get('name'));
        $className = Utils::camelize($name) . $this->options->get('suffix');

        if ($this->options->has('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        if (!$tasksDir = $this->options->get('tasksDir')) {
            $config = $this->getConfig();
            if (empty($config->path('application.tasksDir'))) {
                throw new BuilderException('Please specify a task directory.');
            }

            $tasksDir = $config->path('application.tasksDir');
        }

        // Oops! We are in APP_PATH and try to get tasksDir from outside from project dir
        if ($this->isConsole() && strpos($tasksDir, '../') === 0) {
            $tasksDir = ltrim($tasksDir, './');
        }

        $taskPath = rtrim($tasksDir, '\\/') . DIRECTORY_SEPARATOR . "{$className}.php";
        if (file_exists($taskPath) && !$this->options->has('force')) {
            throw new BuilderException(sprintf('The Task %s already exists.', $name));
        }

        $this->generator->save($taskPath);

        if ($this->isConsole()) {
            $this->notifySuccess(sprintf('Task "%s" was successfully created.', $name));
            $this->notifyInfo($taskPath);
        }

        return $className;
    }

    /**
     * @throws BuilderException
     */
    public function getGenerator(): AbstractEntityGenerator
    {
        if (null === $this->generator) {
            $this->build();
        }

        return $this->generator;
    }

    /**
     * @return string
     * @throws BuilderException
     */
    protected function constructNamespace(): ?string
    {
        $namespace = $this->options->has('namespace') ? (string) $this->options->get('namespace') : null;

        if ($namespace === null) {
            return null;
        }

        return $this->checkNamespace($namespace) && !empty(trim($namespace)) ? $namespace : null;
    }
}
