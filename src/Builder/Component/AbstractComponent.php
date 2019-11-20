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

use Phalcon\Config;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Builder\Path;
use Phalcon\DevTools\Script\Color;
use Phalcon\DevTools\Validation\Validator\Namespaces;
use Phalcon\Validation;

/**
 * Base class for builder components
 */
abstract class AbstractComponent
{
    /**
     * Builder Options
     *
     * @var Config
     */
    protected $options = null;

    /**
     * Path Component
     *
     * @var Path
     */
    protected $path;

    /**
     * Create Builder object
     *
     * @param array $options Builder options
     */
    public function __construct(array $options = [])
    {
        $this->options = new Config($options);
        $this->path = new Path(realpath('.') . DIRECTORY_SEPARATOR);
    }

    /**
     * @param string $namespace
     * @return bool
     * @throws BuilderException
     */
    protected function checkNamespace(string $namespace): bool
    {
        $validation = new Validation();
        $validation->add('namespace', new Namespaces([
            'allowEmpty' => true,
        ]));

        $messages = $validation->validate(['namespace' => $namespace]);
        if (count($messages) > 0) {
            $errors = [];
            foreach ($messages as $message) {
                $errors[] = $message->getMessage();
            }

            throw new BuilderException(sprintf('%s', implode(PHP_EOL, $errors)));
        }

        return true;
    }

    /**
     * Tries to find the current configuration in the application
     *
     * @param string $type Config type: ini | php
     * @return Config
     * @throws BuilderException
     */
    protected function getConfig($type = null): Config
    {
        return $this->path->getConfig($type);
    }

    /**
     * Check if a path is absolute
     *
     * @param string $path Path to check
     * @return bool
     */
    public function isAbsolutePath(string $path): bool
    {
        return $this->path->isAbsolutePath($path);
    }

    /**
     * Check if the script is running on Console mode
     *
     * @return bool
     */
    public function isConsole(): bool
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * Check if the current adapter is supported by Phalcon
     *
     * @param string $adapter
     * @return bool
     * @throws BuilderException
     */
    public function isSupportedAdapter(string $adapter): bool
    {
        if (!class_exists('\Phalcon\Db\Adapter\Pdo\\' . $adapter)) {
            throw new BuilderException("Adapter $adapter is not supported");
        }

        return true;
    }

    /**
     * Shows a success notification
     *
     * @param string $message
     */
    protected function notifySuccess(string $message): void
    {
        print Color::success($message);
    }

    /**
     * Shows a info notification
     *
     * @param string $message
     */
    protected function notifyInfo(string $message): void
    {
        print Color::info($message);
    }

    abstract public function build();
}
