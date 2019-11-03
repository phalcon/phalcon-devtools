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

namespace Phalcon\DevTools;

use Phalcon\DevTools\Error\ErrorHandler;
use Phalcon\Di;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application as MvcApplication;
use Traversable;

/**
 * @method mixed getShared($name, $parameters=null)
 * @method mixed get($name, $parameters=null)
 */
class Bootstrap
{
    use Configurable, Initializable;

    /**
     * Application instance.
     *
     * @var MvcApplication
     */
    protected $app;

    /**
     * The services container.
     *
     * @var DiInterface
     */
    protected $di;

    /**
     * The path to the Phalcon Developers Tools.
     *
     * @var string
     */
    protected $ptoolsPath = '';

    /**
     * The allowed IP for access.
     *
     * @var string
     */
    protected $ptoolsIp = '';

    /**
     * The path where the project was created.
     *
     * @var string
     */
    protected $basePath = '';

    /**
     * The DevTools templates path.
     *
     * @var string
     */
    protected $templatesPath = '';

    /**
     * The current hostname.
     *
     * @var string
     */
    protected $hostName = 'Unknown';

    /**
     * The current application mode.
     *
     * @var string
     */
    protected $mode = 'web';

    /**
     * Configurable parameters
     *
     * @var array
     */
    protected $configurable = [
        'ptools_path',
        'ptools_ip',
        'base_path',
        'host_name',
        'templates_path',
    ];

    /**
     * Parameters that can be set using constants
     *
     * @var array
     */
    protected $defines = [
        'PTOOLSPATH',
        'PTOOLS_IP',
        'BASE_PATH',
        'HOSTNAME',
        'TEMPLATE_PATH',
    ];

    /**
     * @var array
     */
    protected $loaders = [
        'web' => [
            'eventsManager',
            'config',
            'logger',
            'cache',
            'volt',
            'view',
            'annotations',
            'router',
            'url',
            'tag',
            'dispatcher',
            'assets',
            'session',
            'flash',
            'database',
            'accessManager',
            'registry',
            'utils',
            'ui',
        ],
        'cli' => [
            // @todo
        ],
    ];

    /**
     * Bootstrap constructor.
     *
     * @param array|Traversable $parameters
     */
    public function __construct($parameters = [])
    {
        $this->defines = array_combine($this->defines, $this->configurable);

        $this->initFromConstants();
        $this->setParameters($parameters);

        $this->di  = new FactoryDefault;
        $this->app = new MvcApplication;

        (new ErrorHandler)->register();

        foreach ($this->loaders[$this->mode] as $service) {
            $serviceName = ucfirst($service);
            $this->{'init' . $serviceName}();
        }

        $this->app->setEventsManager($this->di->getShared('eventsManager'));

        $this->di->setShared('application', $this->app);
        $this->app->setDI($this->di);

        Di::setDefault($this->di);
    }

    /**
     * Runs the Application.
     *
     * @return MvcApplication|string
     */
    public function run()
    {
        if (PHP_SAPI == 'cli') {
            set_time_limit(0);
        }

        if (ENV_TESTING === APPLICATION_ENV) {
            return $this->app;
        }

        return $this->getOutput();
    }

    /**
     * Get application output.
     *
     * @return string
     */
    public function getOutput()
    {
        return $this->app->handle($_SERVER['REQUEST_URI'])->getContent();
    }

    /**
     * Sets the path to the Phalcon Developers Tools.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPtoolsPath($path)
    {
        $this->ptoolsPath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path to the Phalcon Developers Tools.
     *
     * @return string
     */
    public function getPtoolsPath()
    {
        return $this->ptoolsPath;
    }

    /**
     * Sets the allowed IP for access.
     *
     * @param string $ip
     *
     * @return $this
     */
    public function setPtoolsIp($ip)
    {
        $this->ptoolsIp = trim($ip);

        return $this;
    }

    /**
     * Gets the allowed IP for access.
     *
     * @return string
     */
    public function getPtoolsIp()
    {
        return $this->ptoolsIp;
    }

    /**
     * Sets the path where the project was created.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setBasePath($path)
    {
        $this->basePath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path where the project was created.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Sets the DevTools templates path.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setTemplatesPath($path)
    {
        $this->templatesPath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the DevTools templates path.
     *
     * @return string
     */
    public function getTemplatesPath()
    {
        return $this->templatesPath;
    }

    /**
     * Sets the current application mode.
     *
     * @param string $mode
     *
     * @return $this
     */
    public function setMode($mode)
    {
        $mode = strtolower(trim($mode));

        if (isset($this->loaders[$mode])) {
            $mode = 'web';
        }

        $this->mode = $mode;

        return $this;
    }

    /**
     * Gets the current application mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Sets the current hostname.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setHostName($name)
    {
        $this->hostName = trim($name);

        return $this;
    }

    /**
     * Gets the current application mode.
     *
     * @return string
     */
    public function getHostName()
    {
        return $this->hostName;
    }
}
