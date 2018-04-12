<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

/**
 * Micro
 *
 * Builder to create Micro application skeletons
 *
 * @package Phalcon\Builder\Project
 */
class Xiapi extends ProjectBuilder
{
    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = [
        'app',
        'app/config',
        'app/model',
        'app/controller',
        'app/controller/V1',
        'public',
        'storage',
        'storage/migrations',
        'storage/cache',
        'storage/log',
        'test',
        'test/http',
        '.phalcon'
    ];

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {

        foreach ([
             'config.php',
             'database.php',
             'logger.php',
             'middleware.yml',
             'service.php',
             'validation.php'] as $config) {

            $getFile = $this->options->get('templatePath') . '/project/xiapi/' . $config;
            $putFile = $this->options->get('projectPath') . 'app/config/' . $config;
            $this->generateFile($getFile, $putFile, $this->options->get('name'));
        }

        return $this;
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createIndexFile()
    {
        $getFile = $this->options->get('templatePath') . '/project/xiapi/index.php';
        $putFile = $this->options->get('projectPath') . 'public/index.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    private function createComposerFile()
    {

        $getFile = $this->options->get('templatePath') . '/project/xiapi/composer.json';
        $putFile = $this->options->get('projectPath') . 'composer.json';
        $this->generateFile($getFile, $putFile);


        $getFile = $this->options->get('templatePath') . '/project/xiapi/rest-Client.env.json';
        $putFile = $this->options->get('projectPath') . 'test/http/rest-Client.env.json';
        $this->generateFile($getFile, $putFile);


        $getFile = $this->options->get('templatePath') . '/project/xiapi/demo.http';
        $putFile = $this->options->get('projectPath') . 'test/http/demo.http';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/xiapi/.env.example';
        $putFile = $this->options->get('projectPath') . '.env.example';
        $this->generateFile($getFile, $putFile);

        $putFile = $this->options->get('projectPath') . '.env';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Build project
     *
     * @return bool
     */
    public function build()
    {
        $this
            ->buildDirectories()
            ->createConfig()
            ->createIndexFile()
            ->createComposerFile();

        return true;
    }
}
