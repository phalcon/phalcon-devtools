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
use SplFileInfo;

/**
 * Builder to create module skeletons
 */
class Module extends AbstractComponent
{
    /**
     * @var array
     */
    protected $moduleDirectories = [
        'config',
        'controllers',
        'models',
        'views',
    ];

    /**
     * Stores variable values depending on parameters
     *
     * @var array
     */
    protected $variableValues = [];

    /**
     * Module build
     *
     * @throws BuilderException
     */
    public function build(): void
    {
        if (!$this->options->has('name')) {
            throw new BuilderException('Please, specify the model name');
        }

        if (!$templatePath = $this->options->get('templatePath')) {
            $templatePath =
                str_replace('src/' . str_replace('\\', DIRECTORY_SEPARATOR, __CLASS__) . '.php', '', __FILE__)
                . 'templates' . DIRECTORY_SEPARATOR . 'module';
        }

        if ($this->options->has('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $config = $this->getConfig();

        if (!$modulesDir = $this->options->get('modulesDir')) {
            if (!$config->get('application') || !isset($config->get('application')->modulesDir)) {
                throw new BuilderException("Builder doesn't know where is the modules directory.");
            }

            $modulesDir = $config->get('application')->modulesDir;
        }

        $modulesDir = rtrim($modulesDir, '/\\') . DIRECTORY_SEPARATOR;
        if (!$this->isAbsolutePath($modulesDir)) {
            $modulesDir = $this->path->getRootPath($modulesDir);
        }

        $this->options->offsetSet('modulesDir', $modulesDir);
        $this->options->offsetSet('templatePath', realpath($templatePath));
        $this->options->offsetSet('projectPath', $this->path->getRootPath());

        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createModule();

        $this->notifySuccess(sprintf(
            'Module "%s" was successfully created.',
            $this->options->get('name')
        ));
    }

    /**
     * Build project directories
     *
     * @return $this
     * @throws BuilderException
     */
    public function buildDirectories()
    {
        $modulesDir = $this->options->get('modulesDir');
        $moduleName = $this->options->get('name');

        if (file_exists($modulesDir . DIRECTORY_SEPARATOR . $moduleName)) {
            throw new BuilderException(sprintf(
                'The Module "%s" already exists in modules dir',
                $moduleName
            ));
        }

        $modulesPath = new SplFileInfo($modulesDir);
        $modulePath  = $modulesDir. DIRECTORY_SEPARATOR . $moduleName;

        try {
            if ($modulesPath->isFile() && !$modulesPath->isDir()) {
                throw new BuilderException(
                    sprintf(
                        "Builder expects a directory for 'modulesDir'. But %s is a file.",
                        $modulesPath->getPathname()
                    )
                );
            } elseif ($modulesPath->isReadable() && !mkdir($modulePath, 0777, true)) {
                throw new BuilderException("Unable to create module directory. Check permissions.");
            }

            foreach ($this->moduleDirectories as $dir) {
                $path = $modulePath . DIRECTORY_SEPARATOR . $dir;
                if (!mkdir($path, 0777, true)) {
                    throw new BuilderException(
                        sprintf(
                            "Unable to create %s directory. Check permissions.",
                            $path
                        )
                    );
                }
            }
        } catch (\Exception $e) {
            throw new BuilderException(
                $e->getMessage(),
                (int) $e->getCode(),
                ($e instanceof BuilderException ? null : $e)
            );
        }

        return $this;
    }

    /**
     * Generate file $putFile from $getFile, replacing @@variableValues@@
     *
     * @param string $getFile From file
     * @param string $putFile To file
     * @param string $name
     * @param string $namespace
     */
    protected function generateFile(string $getFile, string $putFile, string $name = '', string $namespace = ''): void
    {
        if (file_exists($putFile)) {
            return;
        }

        touch($putFile);
        $fh = fopen($putFile, "w+");

        $str = file_get_contents($getFile);

        if (!$namespace && $name) {
            $namespace = $name;
        }

        if ($namespace) {
            // default is reserved keyword
            if (strtolower(trim($namespace)) == 'default') {
                $namespace = 'MyDefault';
            }

            $namespace = ucfirst($namespace);
        }

        if ($name && 0 != strcasecmp($namespace, $name)) {
            $namespacePart = $name;

            // default is reserved keyword
            if (strtolower(trim($namespacePart)) == 'default') {
                $namespacePart = 'MyDefault';
            }

            $namespace = $namespace . '\\' . ucfirst($namespacePart);
        }

        $str = preg_replace('/@@name@@/', $name, $str);
        $str = preg_replace('/@@FQMN@@/', $namespace, $str);

        if (count($this->variableValues) > 0) {
            foreach ($this->variableValues as $variableValueKey => $variableValue) {
                $variableValueKeyRegEx = '/@@'.preg_quote($variableValueKey, '/').'@@/';
                $str = preg_replace($variableValueKeyRegEx, $variableValue, $str);
            }
        }

        fwrite($fh, $str);
        fclose($fh);
    }

    /**
     * Generate variable values depending on parameters
     *
     * return $this
     */
    protected function getVariableValues()
    {
        $variableValuesResult = [];
        $variablesJsonFile = $this->options->get('templatePath') . DIRECTORY_SEPARATOR . 'variables.json';

        if (file_exists($variablesJsonFile)) {
            $variableValues = json_decode(file_get_contents($variablesJsonFile), true);
            if ($variableValues) {
                foreach ($this->options as $k => $option) {
                    if (!isset($variableValues[$k])) {
                        continue;
                    }

                    $variableValuesResult = $variableValues[$k][$option];
                }
            }

            $this->variableValues = $variableValuesResult;
        }

        return $this;
    }

    /**
     * Create Module
     *
     * @return $this
     */
    private function createModule()
    {
        $modulesDir = $this->options->get('modulesDir');
        $moduleName = $this->options->get('name');
        $namespace  = $this->options->get('namespace');

        $getFile = $this->options->get('templatePath')  . DIRECTORY_SEPARATOR . 'Module.php';
        $putFile = $modulesDir . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'Module.php';

        $this->generateFile($getFile, $putFile, $moduleName, $namespace);

        return $this;
    }

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->get('config-type', 'php');
        $modulesDir = $this->options->get('modulesDir');
        $moduleName = $this->options->get('name');
        $namespace  = $this->options->get('namespace');

        $getFile = $this->options->get('templatePath')  . DIRECTORY_SEPARATOR . 'config.' . $type;
        $putFile = $modulesDir . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR;
        $putFile .= 'config' . DIRECTORY_SEPARATOR . 'config.' . $type;

        $this->generateFile(
            $getFile,
            $putFile,
            $moduleName,
            $namespace
        );

        return $this;
    }
}
