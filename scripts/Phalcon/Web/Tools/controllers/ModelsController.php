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

use Phalcon\Tag;
use Phalcon\Web\Tools;
use Phalcon\Builder\BuilderException;

class ModelsController extends ControllerBase
{

    public function indexAction()
    {
        $this->listTables(true);
    }

    /**
     * Generate models
     */
    public function createAction()
    {

        if ($this->request->isPost()) {

            $force = $this->request->getPost('force', 'int');
            $schema = $this->request->getPost('schema');
            $tableName = $this->request->getPost('tableName');
            $genSettersGetters = $this->request->getPost('genSettersGetters', 'int');
            $foreignKeys = $this->request->getPost('foreignKeys', 'int');
            $defineRelations = $this->request->getPost('defineRelations', 'int');

            try {

                $component = '\Phalcon\Builder\Model';
                if ($tableName == 'all') {
                    $component = '\Phalcon\Builder\AllModels';
                }

                $modelBuilder = new $component(array(
                    'name'                  => $tableName,
                    'force'                 => $force,
                    'modelsDir'             => Tools::getConfig()->application->modelsDir,
                    'directory'             => null,
                    'foreignKeys'           => $foreignKeys,
                    'defineRelations'       => $defineRelations,
                    'genSettersGetters'     => $genSettersGetters,
                    'namespace'             => null,
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
                    $this->flash->success('Models were created successfully');
                } else {
                    $this->flash->success('Model "'.$tableName.'" was created successfully');
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
        $this->view->setVar('modelsDir', Tools::getConfig()->application->modelsDir);
    }

    public function editAction($fileName)
    {

        $fileName = str_replace('..', '', $fileName);

        $modelsDir = Tools::getConfig()->application->modelsDir;

        if (!file_exists($modelsDir.'/'.$fileName)) {
            $this->flash->error('Model could not be found');

            return $this->dispatcher->forward(array(
                'controller' => 'models',
                'action' => 'list'
            ));
        }

        $this->tag->setDefault('code', file_get_contents($modelsDir.'/'.$fileName));
        $this->tag->setDefault('name', $fileName);
        $this->view->setVar('name', $fileName);

    }

    public function saveAction()
    {

        if ($this->request->isPost()) {

            $fileName = $this->request->getPost('name', 'string');

            $fileName = str_replace('..', '', $fileName);

            $modelsDir = Tools::getConfig()->application->modelsDir;
            if (!file_exists($modelsDir.'/'.$fileName)) {
                $this->flash->error('Model could not be found');

                return $this->dispatcher->forward(array(
                    'controller' => 'models',
                    'action' => 'list'
                ));
            }

            if (!is_writable($modelsDir.'/'.$fileName)) {
                $this->flash->error('Model file does not has write access');

                return $this->dispatcher->forward(array(
                    'controller' => 'models',
                    'action' => 'list'
                ));
            }

            file_put_contents($modelsDir.'/'.$fileName, $this->request->getPost('code'));

            $this->flash->success('The model "'.$fileName.'" was saved successfully');
        }

        return $this->dispatcher->forward(array(
            'controller' => 'models',
            'action' => 'list'
        ));
    }
}
