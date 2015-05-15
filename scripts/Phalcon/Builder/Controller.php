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

use Phalcon\Text as Utils;

/**
 * Controller Class
 *
 * Builder to generate controller
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Controller extends Component
{
    /**
     * Create Builder object
     *
     * @param array $options Builder options
     * @throws BuilderException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['name'])) {
            throw new BuilderException('Please specify the controller name.');
        }

        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        parent::__construct($options);
    }

    /**
     * @return string
     * @throws \Phalcon\Builder\BuilderException
     */
    public function build()
    {
        if ($this->options->contains('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $namespace = '';
        if ($this->options->contains('namespace') && $this->checkNamespace($this->options->get('namespace'))) {
            $namespace = 'namespace '.$this->options->get('namespace').';'.PHP_EOL.PHP_EOL;
        }

        $baseClass = $this->options->get('baseClass', '\Phalcon\Mvc\Controller');

        if (!$controllersDir = $this->options->get('controllersDir')) {
            $config = $this->getConfig();
            if (!isset($config->application->controllersDir)) {
                throw new BuilderException('Please specify a controller directory.');
            }

            $controllersDir = $config->application->controllersDir;
        }

        if (!$this->options->contains('name')) {
            throw new BuilderException('The controller name is required.');
        }

        $name = str_replace(' ', '_', $this->options->get('name'));

        $className = Utils::camelize($name);

        // Oops! We are in APP_PATH and try to get controllersDir from outside from project dir
        if ($this->isConsole() && substr($controllersDir, 0, 3) === '../') {
            $controllersDir = ltrim($controllersDir, './');
        }

        $controllerPath = rtrim($controllersDir, '\\/') . DIRECTORY_SEPARATOR . $className . "Controller.php";

        $code = "<?php\n\n".$namespace."class ".$className."Controller extends ".$baseClass."\n{\n\n\tpublic function indexAction()\n\t{\n\n\t}\n\n}\n\n";
        $code = str_replace("\t", "    ", $code);

        if (file_exists($controllerPath)) {
            if ($this->options->contains('force') && !is_writable($controllerPath)) {
                throw new BuilderException(sprintf('Unable to write to %s. Check write-access of a file.', $controllerPath));
            } else {
                throw new BuilderException(sprintf('The Controller %s already exists.', $name));
            }
        }

        if (!@file_put_contents($controllerPath, $code)) {
            throw new BuilderException(sprintf('Unable to write to %s.', $controllerPath));
        }

        if ($this->isConsole()) {
            $this->_notifySuccess(sprintf('Controller "%s" was successfully created.', $name));
        }

        return $className . 'Controller.php';
    }
}
