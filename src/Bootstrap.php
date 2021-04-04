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
use Phalcon\DevTools\Exception\InvalidArgumentException;
use Phalcon\DevTools\Providers\AccessManagerProvider;
use Phalcon\DevTools\Providers\AnnotationsProvider;
use Phalcon\DevTools\Providers\AssetsProvider;
use Phalcon\DevTools\Providers\AssetsResourceProvider;
use Phalcon\DevTools\Providers\ConfigProvider;
use Phalcon\DevTools\Providers\DatabaseProvider;
use Phalcon\DevTools\Providers\DataCacheProvider;
use Phalcon\DevTools\Providers\DbUtilsProvider;
use Phalcon\DevTools\Providers\DispatcherProvider;
use Phalcon\DevTools\Providers\EventsManagerProvider;
use Phalcon\DevTools\Providers\FileSystemProvider;
use Phalcon\DevTools\Providers\FlashSessionProvider;
use Phalcon\DevTools\Providers\LoggerProvider;
use Phalcon\DevTools\Providers\ModelsCacheProvider;
use Phalcon\DevTools\Providers\RegistryProvider;
use Phalcon\DevTools\Providers\RouterProvider;
use Phalcon\DevTools\Providers\SessionProvider;
use Phalcon\DevTools\Providers\SystemInfoProvider;
use Phalcon\DevTools\Providers\TagProvider;
use Phalcon\DevTools\Providers\UrlProvider;
use Phalcon\DevTools\Providers\ViewCacheProvider;
use Phalcon\DevTools\Providers\ViewProvider;
use Phalcon\DevTools\Providers\VoltProvider;
use Phalcon\Di;
use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Application as MvcApplication;
use Phalcon\Text;

/**
 * @method mixed getShared($name, $parameters=null)
 * @method mixed get($name, $parameters=null)
 */
class Bootstrap
{
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
            AccessManagerProvider::class,
            EventsManagerProvider::class,
            ConfigProvider::class,
            LoggerProvider::class,
            DataCacheProvider::class,
            ModelsCacheProvider::class,
            ViewCacheProvider::class,
            VoltProvider::class,
            ViewProvider::class,
            AnnotationsProvider::class,
            RouterProvider::class,
            UrlProvider::class,
            TagProvider::class,
            DispatcherProvider::class,
            AssetsProvider::class,
            SessionProvider::class,
            FlashSessionProvider::class,
            DatabaseProvider::class,
            RegistryProvider::class,
            FileSystemProvider::class,
            DbUtilsProvider::class,
            SystemInfoProvider::class,
            AssetsResourceProvider::class,
        ],
        'cli' => [
            // @todo
        ],
    ];

    /**
     * Bootstrap constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->defines = array_combine($this->defines, $this->configurable);

        $this->initFromConstants();
        $this->setParameters($parameters);

        $this->di = new FactoryDefault;
        $this->app = new MvcApplication;
        $this->di->setShared('application', $this);

        (new ErrorHandler)->register();

        foreach ($this->loaders[$this->mode] as $providerClass) {
            /** @var ServiceProviderInterface $provider */
            $provider = new $providerClass;
            $provider->register($this->di);
        }

        $this->app->setEventsManager($this->di->getShared('eventsManager'));
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
        if (PHP_SAPI === 'cli') {
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
    public function getOutput(): string
    {
        return $this->app->handle($this->getCurrentUri())->getContent();
    }

    /**
     * Sets the path to the Phalcon Developers Tools.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPtoolsPath(string $path): Bootstrap
    {
        $this->ptoolsPath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path to the Phalcon Developers Tools.
     *
     * @return string
     */
    public function getPtoolsPath(): string
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
    public function setPtoolsIp(string $ip): Bootstrap
    {
        $this->ptoolsIp = trim($ip);

        return $this;
    }

    /**
     * Gets the allowed IP for access.
     *
     * @return string
     */
    public function getPtoolsIp(): string
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
    public function setBasePath(string $path): Bootstrap
    {
        $this->basePath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path where the project was created.
     *
     * @return string
     */
    public function getBasePath(): string
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
    public function setTemplatesPath(string $path): Bootstrap
    {
        $this->templatesPath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the DevTools templates path.
     *
     * @return string
     */
    public function getTemplatesPath(): string
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
    public function setMode(string $mode): Bootstrap
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
    public function getMode(): string
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
    public function setHostName(string $name): Bootstrap
    {
        $this->hostName = trim($name);

        return $this;
    }

    /**
     * Gets the current application mode.
     *
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * Sets the params by using passed config.
     *
     * @param array $parameters
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setParameters(array $parameters): Bootstrap
    {
        foreach ($this->configurable as $param) {
            if (!isset($parameters[$param])) {
                continue;
            }

            $this->setParameter($param, $parameters[$param]);
        }

        return $this;
    }

    /**
     * Sets the parameter by using snake_case notation.
     *
     * @param string $parameter Parameter name
     * @param mixed $value The value
     * @return $this
     */
    public function setParameter(string $parameter, $value): Bootstrap
    {
        $method = 'set' . Text::camelize($parameter);

        if (method_exists($this, $method)) {
            $this->$method($value);
        }

        return $this;
    }

    /**
     * Sets the params by using defined constants.
     *
     * @return $this
     */
    public function initFromConstants(): Bootstrap
    {
        foreach ($this->defines as $const => $property) {
            if (defined($const) && in_array($property, $this->configurable, true)) {
                $this->setParameter($property, constant($const));
            }
        }

        return $this;
    }

    public function getCurrentUri(): string
    {
        $baseUrl = $this->di->getShared('url')->getBaseUri();

        return str_replace(
            basename($_SERVER['SCRIPT_FILENAME']),
            '',
            substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], $baseUrl) + strlen($baseUrl))
        );
    }
}
