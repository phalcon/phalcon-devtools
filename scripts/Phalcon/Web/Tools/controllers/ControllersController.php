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

class ControllersController extends ControllerBase
{

    public function indexAction()
    {

    }

    /**
     * Generate controller
     */
    public function createAction()
    {

        if ($this->request->isPost()) {

            $controllerName = $this->request->getPost('name', 'string');
            $force = $this->request->getPost('force', 'int');

            try {

                $controllerBuilder = new \Phalcon\Builder\Controller(array(
                    'name' => $controllerName,
                    'directory' => null,
                    'namespace' => null,
                    'baseClass' => null,
                    'force' => $force
                ));

                $fileName = $controllerBuilder->build();

                $this->flash->success('The controller "'.$fileName.'" was created successfully');

                return $this->dispatcher->forward(array(
                    'controller' => 'controllers',
                    'action' => 'edit',
                    'params' => array($fileName)
                ));

            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            }

        }

        return $this->dispatcher->forward(array(
            'controller' => 'controllers',
            'action' => 'index'
        ));

    }

    /**
     *
     */
    public function listAction()
    {
        $this->view->setVar('controllersDir', Tools::getConfig()->application->controllersDir);
    }

    /**
     * @param $fileName
     *
     * @return mixed
     */
    public function editAction($fileName)
    {

        $fileName = str_replace('..', '', $fileName);

        $controllersDir = Tools::getConfig()->application->controllersDir;
        if (!file_exists($controllersDir.'/'.$fileName)) {
            $this->flash->error('Controller could not be found', 'alert alert-error');

            return $this->dispatcher->forward(array(
                'controller' => 'controllers',
                'action' => 'list'
            ));
        }

        $this->tag->setDefault('code', file_get_contents($controllersDir.'/'.$fileName));
        $this->tag->setDefault('name', $fileName);
        $this->view->setVar('name', $fileName);

    }

    /**
     * @return mixed
     */
    public function saveAction()
    {

        if ($this->request->isPost()) {

            $fileName = $this->request->getPost('name', 'string');

            $fileName = str_replace('..', '', $fileName);

            $controllersDir = Tools::getConfig()->application->controllersDir;
            if (!file_exists($controllersDir . '/' . $fileName)) {
                $this->flash->error('Controller could not be found');

                return $this->dispatcher->forward(array(
                    'controller' => 'controllers',
                    'action' => 'list'
                ));
            }

            if (!is_writable($controllersDir.'/'.$fileName)) {
                $this->flash->error('Controller file does not has write access');

                return $this->dispatcher->forward(array(
                    'controller' => 'controllers',
                    'action' => 'list'
                ));
            }

            file_put_contents($controllersDir.'/'.$fileName, $this->request->getPost('code'));

            $this->flash->success('The controller "'.$fileName.'" was saved successfully');
        }

        return $this->dispatcher->forward(array(
            'controller' => 'controllers',
            'action' => 'list'
        ));

    }
}
