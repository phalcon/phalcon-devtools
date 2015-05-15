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
  |          Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

use Phalcon\Tag;
use Phalcon\Builder\BuilderException;
use Phalcon\Text as Utils;

class ModelsController extends ControllerBase
{
    public function indexAction()
    {
        $this->listTables(true);

        if (!$this->modelsDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where is the models directory. <br>" .
                "Please add to <code>application</code> section <code>modelsDir</code> param with valid path."
            );
        }

        $this->view->setVars(array(
            'directory' => dirname(getcwd())
        ));
    }

    /**
     * Generate models
     */
    public function createAction()
    {
        if ($this->request->isPost()) {
            $force             = $this->request->getPost('force', 'int');
            $schema            = $this->request->getPost('schema');
            $directory         = $this->request->getPost('directory');
            $namespace         = $this->request->getPost('namespace');
            $tableName         = $this->request->getPost('tableName');
            $genSettersGetters = $this->request->getPost('genSettersGetters', 'int');
            $foreignKeys       = $this->request->getPost('foreignKeys', 'int');
            $defineRelations   = $this->request->getPost('defineRelations', 'int');
            $mapcolumn         = $this->request->getPost('mapcolumn', 'int');

            try {
                $component = '\Phalcon\Builder\Model';
                if ($tableName == 'all') {
                    $component = '\Phalcon\Builder\AllModels';
                }

                $modelBuilder = new $component(array(
                    'name'                  => $tableName,
                    'force'                 => $force,
                    'modelsDir'             => $this->modelsDir,
                    'directory'             => $directory,
                    'foreignKeys'           => $foreignKeys,
                    'defineRelations'       => $defineRelations,
                    'genSettersGetters'     => $genSettersGetters,
                    'namespace'             => $namespace,
                    'schema'                => $schema,
                    'mapColumn'             => $mapcolumn
                ));

                $modelBuilder->build();

                if ($tableName == 'all') {
                    if (($n = count($modelBuilder->exist)) > 0) {
                        $mList = implode('</strong>, <strong>', $modelBuilder->exist);

                        if ($n == 1) {
                            $notice = 'Model <strong>' . $mList . '</strong> was skipped because it already exists!';
                        } else {
                            $notice = 'Models <strong>' . $mList . '</strong> were skipped because they already exists!';
                        }

                        $this->flash->notice($notice);
                    }
                }

                if ($tableName == 'all') {
                    $this->flash->success('Models were created successfully.');
                } else {
                    $this->flash->success(sprintf('Model "%s" was created successfully', Utils::camelize(str_replace('.php', '', $tableName))));
                }
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }
        }

        return $this->dispatcher->forward(array(
            'controller' => 'models',
            'action' => 'list'
        ));
    }

    public function listAction()
    {
        $this->view->setVars(array(
            'modelsDir' => $this->modelsDir,
            'fileOwner' => $this->fileOwner
        ));
    }

    /**
     * Edit Model
     *
     * @param string $fileName Model Name
     *
     * @return mixed
     */
    public function editAction($fileName)
    {
        $fileName = str_replace('..', '', $fileName);

        if (!file_exists($this->modelsDir . $fileName)) {
            $this->flash->error(sprintf('Model %s could not be found.', $this->modelsDir . $fileName));

            return $this->dispatcher->forward(array(
                'controller' => 'models',
                'action' => 'list'
            ));
        }

        $this->tag->setDefault('code', file_get_contents($this->modelsDir . $fileName));
        $this->tag->setDefault('name', $fileName);
        $this->view->setVar('name', $fileName);
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $fileName = $this->request->getPost('name', 'string');

            $fileName = str_replace('..', '', $fileName);

            if (!file_exists($this->modelsDir . $fileName)) {
                $this->flash->error('Model could not be found.');

                return $this->dispatcher->forward(array(
                    'controller' => 'models',
                    'action' => 'list'
                ));
            }

            if (!is_writable($this->modelsDir . $fileName)) {
                $this->flash->error('Model file does not has write access.');

                return $this->dispatcher->forward(array(
                    'controller' => 'models',
                    'action' => 'list'
                ));
            }

            file_put_contents($this->modelsDir . $fileName, $this->request->getPost('code'));

            $this->flash->success(sprintf('The model "%s" was saved successfully.', str_replace('.php', '', $fileName)));
        }

        return $this->dispatcher->forward(array(
            'controller' => 'models',
            'action' => 'list'
        ));
    }
}
