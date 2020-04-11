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
use Phalcon\DevTools\Bootstrap;
use Phalcon\DevTools\Utils\FsUtils;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Registry;

class RegistryProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'registry';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        /** @var Bootstrap $bootstrap */
        $bootstrap = $di->getShared('application');

        $basePath = $bootstrap->getBasePath();
        $ptoolsPath = $bootstrap->getPtoolsPath();
        $templatesPath = $bootstrap->getTemplatesPath();

        $di->setShared($this->providerName, function () use ($basePath, $ptoolsPath, $templatesPath) {
            /**
             * @var DiInterface $this
             */

            $registry = new Registry;

            /* @var Config $config */
            $config = $this->getShared('config');

            /* @var FsUtils $fs */
            $fs = $this->getShared('fs');

            $basePath = $fs->normalize(rtrim($basePath, '\\/'));
            $ptoolsPath = $fs->normalize(rtrim($ptoolsPath, '\\/'));
            $templatesPath = $fs->normalize(rtrim($templatesPath, '\\/'));

            $requiredDirectories = [
                'modelsDir',
                'controllersDir',
                'migrationsDir',
            ];

            $directories = [
                'modelsDir' => null,
                'controllersDir' => null,
                'migrationsDir' => null,
                'basePath' => $basePath,
                'ptoolsPath' => $ptoolsPath,
                'templatesPath' => $templatesPath,
                'webToolsViews' => $fs->normalize($ptoolsPath . '/src/Web/Tools/Views'),
                'resourcesDir' => $fs->normalize($ptoolsPath . '/resources'),
                'elementsDir' => $fs->normalize($ptoolsPath . '/resources/elements')
            ];

            if (($application = $config->get('application')) instanceof Config) {
                foreach ($requiredDirectories as $name) {
                    if ($possiblePath = $application->get($name)) {
                        if (!$fs->isAbsolute($possiblePath)) {
                            $possiblePath = $basePath . DS . $possiblePath;
                        }

                        $possiblePath = $fs->normalize($possiblePath);
                        if (is_readable($possiblePath) && is_dir($possiblePath)) {
                            $directories[$name] = $possiblePath;
                        }
                    }
                }
            }

            $registry->offsetSet('directories', (object)$directories);

            return $registry;
        });
    }
}
