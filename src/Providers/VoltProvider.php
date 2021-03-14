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

namespace Phalcon\DevTools\Providers;

use Phalcon\Config;
use Phalcon\DevTools\Mvc\View\Engine\Volt\Extension\Php as PhpExt;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class VoltProvider implements ServiceProviderInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    /**
     * @var string
     */
    protected $providerName = 'volt';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $this->di = $di;
        $basePath = $di->getShared('application')->getBasePath();
        $ptoolsPath = $di->getShared('application')->getPtoolsPath();
        $that = $this;

        $di->setShared($this->providerName, function ($view, $di) use ($basePath, $ptoolsPath, $that) {
            /** @var DiInterface $this */

            $volt = new VoltEngine($view, $di);
            $config = $this->getShared('config');

            $appCacheDir = $config->get('application', new Config)->get('cacheDir');
            $defaultCacheDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'phalcon' . DIRECTORY_SEPARATOR . 'volt';

            /** @var Config $voltConfig */
            $voltConfig = null;
            if ($config->offsetExists('volt')) {
                $voltConfig = $config->get('volt');
            } elseif ($config->offsetExists('view')) {
                $voltConfig = $config->get('view');
            }

            if (!$voltConfig instanceof Config) {
                $voltConfig = new Config([
                    'compiledExt' => '.php',
                    'separator' => '_',
                    'cacheDir' => $appCacheDir ?: $defaultCacheDir,
                    'forceCompile' => ENV_DEVELOPMENT === APPLICATION_ENV,
                ]);
            }

            $compiledPath = function ($templatePath) use (
                $voltConfig,
                $basePath,
                $ptoolsPath,
                $that
            ) {
                /**
                 * @var DiInterface $this
                 * @var Config $voltConfig
                 */
                if (0 === strpos($templatePath, $basePath)) {
                    $templatePath = substr($templatePath, strlen($basePath));
                } elseif (0 === strpos($templatePath, $ptoolsPath . DIRECTORY_SEPARATOR . 'src')) {
                    $templatePath = substr($templatePath, strlen($ptoolsPath . DIRECTORY_SEPARATOR . 'src'));
                }

                $templatePath = trim($templatePath, '\\/');
                $filename = str_replace(['\\', '/'], $voltConfig->get('separator', '_'), $templatePath);
                $filename = basename($filename, '.volt') . $voltConfig->get('compiledExt', '.php');

                $cacheDir = $that->getCacheDir($voltConfig);

                return rtrim($cacheDir, '\\/') . DIRECTORY_SEPARATOR . $filename;
            };

            $options = [
                'path' => $voltConfig->get('compiledPath', $compiledPath),
                'always' => ENV_DEVELOPMENT === APPLICATION_ENV || boolval($voltConfig->get('forceCompile')),
            ];

            $volt->setOptions($options);
            $volt->getCompiler()->addExtension(new PhpExt);

            return $volt;
        });
    }

    /**
     * get volt cache directory
     *
     * @param Config $voltConfig
     *
     * @return string
     */
    protected function getCacheDir(Config $voltConfig): string
    {
        $appCacheDir = $this->di->getShared('config')->path('application.cacheDir');
        $cacheDir = $voltConfig->get('cacheDir', $appCacheDir);
        $defaultCacheDir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'phalcon' . DIRECTORY_SEPARATOR . 'volt';

        if ($cacheDir && is_dir($cacheDir) && is_writable($cacheDir)) {
            return $cacheDir;
        }

        $this->di->getShared('logger')->warning(
            'Unable to initialize Volt cache dir: {cache}. Used temp path: {default}',
            [
                'cache'   => $cacheDir,
                'default' => $defaultCacheDir
            ]
        );

        if (!is_dir($defaultCacheDir)) {
            mkdir($defaultCacheDir, 0777, true);
        }

        return $defaultCacheDir;
    }
}
