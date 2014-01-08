<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Web\Tools;
use Phalcon\Builder\BuilderException;

class MigrationsController extends ControllerBase
{

    /**
     * @return string
     */
    protected function _getMigrationsDir()
    {
        $migrationsDir = 'app/migrations';
        if (!file_exists($migrationsDir)) {
            mkdir($migrationsDir);
        }

        return $migrationsDir;
    }

    protected function _prepareVersions()
    {

        $migrationsDir = $this->_getMigrationsDir();

        $folders = array();

        $iterator = new DirectoryIterator($migrationsDir);
        foreach ($iterator as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $folders[$fileinfo->getFileName()] = $fileinfo->getFileName();
            }
        }

        natsort($folders);
        $folders = array_reverse($folders);
        $foldersKeys = array_keys($folders);

        if (isset($foldersKeys[0])) {
            $this->view->setVar('version', $foldersKeys[0]);
        } else {
            $this->view->setVar('version', 'None');
        }

    }

    public function indexAction()
    {
        $this->_prepareVersions();
        $this->listTables();
    }

    /**
     * Generates migrations
     */
    public function generateAction()
    {

         if ($this->request->isPost()) {

            $exportData = '';
            $tableName = $this->request->getPost('table-name', 'string');
            $version = $this->request->getPost('version', 'string');
            $force = $this->request->getPost('force', 'int');

            $migrationsDir = $this->_getMigrationsDir();

            try {

                \Phalcon\Migrations::generate(array(
                    'config' => Tools::getConfig(),
                    'directory' => null,
                    'tableName' => $tableName,
                    'exportData' => $exportData,
                    'migrationsDir' => $migrationsDir,
                    'originalVersion' => $version,
                    'force' => $force
                ));

                $this->flash->success("The migration was generated successfully");
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }

        }

        return $this->dispatcher->forward(array(
            'controller' => 'migrations',
            'action' => 'index'
        ));

    }

    /*
     *
     */
    public function runAction()
    {

        if ($this->request->isPost()) {

            $version = '';
            $exportData = '';
            $force = $this->request->getPost('force', 'int');

            try {

                $migrationsDir = $this->_getMigrationsDir();

                \Phalcon\Migrations::run(array(
                    'config' => Tools::getConfig(),
                    'directory' => null,
                    'tableName' => 'all',
                    'migrationsDir' => $migrationsDir,
                    'force' => $force
                ));

                $this->flash->success("The migration was executed successfully");
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }
        }

        $this->_prepareVersions();

    }

}
