<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
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
use Phalcon\Migrations;
use Phalcon\Builder\BuilderException;
use Phalcon\Web\Tools\Traits\DatabaseAware;

class MigrationsController extends ControllerBase
{
    use DatabaseAware;

    protected function _prepareVersions()
    {
        if (!$this->migrationsDir) {
            $this->view->setVar('version', 'None');
            return;
        }

        $folders = [];
        $iterator = new DirectoryIterator($this->migrationsDir);
        foreach ($iterator as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $folders[$fileinfo->getFilename()] = $fileinfo->getFilename();
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
        if (!$this->migrationsDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where the migrations directory is. <br>" .
                "Please add to <code>application</code> section <code>migrationsDir</code> param with real path."
            );
        }

        $this->_prepareVersions();
        $this->listTables(true);

        $this->view->setVars([
            'projectDir' => $this->projectDir,
        ]);
    }

    /**
     * Generates migrations
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            $directory     = $this->request->getPost('projectDir', 'string', $this->projectDir);
            $exportData    = $this->request->getPost('exportData', 'int');
            $tableName     = $this->request->getPost('table-name', 'string');
            $version       = $this->request->getPost('version', 'string');
            $force         = $this->request->getPost('force', 'int');
            $noAi          = $this->request->getPost('noAi', 'int');
            $migrationsDir = $this->request->getPost('migrationsDir', 'string', $this->migrationsDir);
            $descr         = null; // @todo

            try {

                Migrations::generate([
                    'directory'       => $directory,
                    'tableName'       => $tableName,
                    'exportData'      => $exportData,
                    'migrationsDir'   => $migrationsDir,
                    'force'           => $force,
                    'noAutoIncrement' => $noAi,
                    'config'          => Tools::getConfig(),
                    'descr'           => $descr,
                    'version'         => $version,
                ]);

                $this->flash->success('The migration was generated successfully.');
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            } catch (Exception $e) {
                $this->flash->error($e->getMessage());
            }
        }

        $this->dispatcher->forward([
            'controller' => 'migrations',
            'action'     => 'index'
        ]);
    }

    public function runAction()
    {
        if ($this->request->isPost()) {
            $force = $this->request->getPost('force', 'int');

            try {
                Migrations::run(array(
                    'config' => Tools::getConfig(),
                    'directory'     => null,
                    'tableName'     => 'all',
                    'migrationsDir' => $this->migrationsDir,
                    'force'         => $force
                ));

                $this->flash->success('The migration was executed successfully.');
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }
        }

        $this->_prepareVersions();
    }
}
