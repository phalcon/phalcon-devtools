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
use Phalcon\DevTools\Builder\Project\Cli;
use Phalcon\DevTools\Builder\Project\Micro;
use Phalcon\DevTools\Builder\Project\Modules;
use Phalcon\DevTools\Builder\Project\ProjectBuilder;
use Phalcon\DevTools\Builder\Project\Simple;
use Phalcon\DevTools\Utils\FsUtils;
use SplFileInfo;

/**
 * Builder to create application skeletons
 */
class Project extends AbstractComponent
{
    const TYPE_MICRO   = 'micro';
    const TYPE_SIMPLE  = 'simple';
    const TYPE_MODULES = 'modules';
    const TYPE_CLI     = 'cli';

    /**
     * Current Project Type
     *
     * @var string
     */
    private $currentType = self::TYPE_SIMPLE;

    /**
     * Available Project Types
     *
     * @var array
     */
    private $types = [
        self::TYPE_MICRO   => Micro::class,
        self::TYPE_SIMPLE  => Simple::class,
        self::TYPE_MODULES => Modules::class,
        self::TYPE_CLI     => Cli::class,
    ];

    /**
     * Project build
     *
     * @throws BuilderException
     */
    public function build()
    {
        if ($this->options->has('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $templatePath =
            str_replace('src/' . str_replace('\\', DIRECTORY_SEPARATOR, __CLASS__) . '.php', '', __FILE__) .
            'templates';

        if ($this->options->has('templatePath')) {
            $templatePath = $this->options->get('templatePath');
        }

        if ($this->path->hasPhalconDir()) {
            throw new BuilderException('Projects cannot be created inside Phalcon projects.');
        }

        $this->currentType = $this->options->get('type');

        if (!isset($this->types[$this->currentType])) {
            throw new BuilderException(sprintf(
                'Type "%s" is not a valid type. Choose among [%s] ',
                $this->currentType,
                implode(', ', array_keys($this->types))
            ));
        }

        $builderClass = $this->types[$this->currentType];

        if ($this->options->has('name')) {
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

        /** @var ProjectBuilder $builder */
        $builder = new $builderClass($this->options);
        $success = $builder->build();

        $root = new SplFileInfo($this->path->getRootPath('public'));
        $fsUtils = new FsUtils();
        $fsUtils->setDirectoryPermission($root, ['css' => 0777, 'js' => 0777]);

        if ($success === true) {
            $this->notifySuccess(sprintf("Project '%s' was successfully created.", $this->options->get('name')));
            $this->notifyInfo("Please choose a password and username to use Database connection.");
            $this->notifyInfo("Used default: 'root' without password.");
        }

        return $success;
    }
}
