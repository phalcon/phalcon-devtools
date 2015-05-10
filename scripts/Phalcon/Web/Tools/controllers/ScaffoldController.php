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

use Phalcon\Builder\BuilderException;
use Phalcon\Builder\Scaffold;
use Phalcon\Text as Utils;

class ScaffoldController extends ControllerBase
{
    public function indexAction()
    {
        $errorMessage = function ($directoryName, $directoryPath) {
            return sprintf(
                "Sorry, WebTools doesn't know where is the %s directory. <br>" .
                "Please add to <code>application</code> section <code>%s</code> param with valid path.",
                $directoryName,
                $directoryPath
            );
        };

        if (!$this->controllersDir) {
            $this->flash->error($errorMessage('controllers', 'controllersDir'));
        }

        if (!$this->modelsDir) {
            $this->flash->error($errorMessage('models', 'modelsDir'));
        }

        $this->listTables();

        $this->view->setVars(array(
            'directory'       => dirname(getcwd()),
            'templateEngines' => array(
                'volt' => 'volt',
                'php'  => 'php',
            )
        ));
    }

    /**
     * Generate Scaffold
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            $schema            = $this->request->getPost('schema', 'string');
            $tableName         = $this->request->getPost('tableName', 'string');
            $version           = $this->request->getPost('version', 'string');
            $templateEngine    = $this->request->getPost('templateEngine');
            $force             = $this->request->getPost('force', 'int');
            $genSettersGetters = $this->request->getPost('genSettersGetters', 'int');
            $directory         = $this->request->getPost('directory');
            $modelsNamespace   = $this->request->getPost('modelsNamespace', 'trim');

            try {
                $scaffoldBuilder = new Scaffold(array(
                    'name'              => $tableName,
                    'schema'            => $schema,
                    'force'             => $force,
                    'genSettersGetters' => $genSettersGetters,
                    'directory'         => $directory,
                    'templatePath'      => TEMPLATE_PATH,
                    'templateEngine'    => $templateEngine,
                    'modelsNamespace'   => $modelsNamespace,
                ));

                $scaffoldBuilder->build();

                $this->flash->success(sprintf('Scaffold for table "%s" was generated successfully', Utils::camelize($tableName)));

                return $this->dispatcher->forward(array(
                    'controller' => 'scaffold',
                    'action' => 'index'
                ));
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }
        }

        return $this->dispatcher->forward(array(
            'controller' => 'scaffold',
            'action' => 'index'
        ));
    }
}
