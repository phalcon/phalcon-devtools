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
use Phalcon\Builder\Controller as ControllerBuilder;

class ControllersController extends ControllerBase
{
    public function indexAction()
    {
        if (!$this->controllersDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where is the controllers directory. <br>" .
                "Please add to <code>application</code> section <code>controllersDir</code> param with valid path."
            );
        }

        $this->view->setVars([
            'directory' => dirname(getcwd())
        ]);
    }

    /**
     * Generate controller
     */
    public function createAction()
    {
        if ($this->request->isPost()) {
            $force          = $this->request->getPost('force', 'int');
            $controllerName = $this->request->getPost('name', 'string');
            $directory      = $this->request->getPost('directory');
            $namespace      = $this->request->getPost('namespace');
            $baseClass      = $this->request->getPost('baseClass');

            try {
                $controllerBuilder = new ControllerBuilder(array(
                    'name'           => $controllerName,
                    'directory'      => $directory,
                    'namespace'      => $namespace,
                    'baseClass'      => $baseClass,
                    'force'          => $force,
                    'controllersDir' => $this->controllersDir
                ));

                $fileName = $controllerBuilder->build();

                $this->flash->success(sprintf('Model "%s" was created successfully', str_replace('.php', '', $fileName)));

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

    public function listAction()
    {
        $this->view->setVars(array(
            'controllersDir' => $this->controllersDir,
            'fileOwner' => $this->fileOwner
        ));
    }

    /**
     * Edit Controller
     *
     * @param string $fileName Controller Name
     *
     * @return mixed
     */
    public function editAction($fileName)
    {
        $fileName = str_replace('..', '', $fileName);

        if (!file_exists($this->controllersDir . $fileName)) {
            $this->flash->error('Controller could not be found.');

            return $this->dispatcher->forward(array(
                'controller' => 'controllers',
                'action' => 'list'
            ));
        }

        $this->tag->setDefault('code', file_get_contents($this->controllersDir . $fileName));
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

            if (!file_exists($this->controllersDir . $fileName)) {
                $this->flash->error('Controller could not be found.');

                return $this->dispatcher->forward(array(
                    'controller' => 'controllers',
                    'action' => 'list'
                ));
            }

            if (!is_writable($this->controllersDir . $fileName)) {
                $this->flash->error('Controller file does not has write access.');

                return $this->dispatcher->forward(array(
                    'controller' => 'controllers',
                    'action' => 'list'
                ));
            }

            file_put_contents($this->controllersDir . $fileName, $this->request->getPost('code'));

            $this->flash->success(sprintf('The controller "%s" was saved successfully.', str_replace('.php', '', $fileName)));
        }

        return $this->dispatcher->forward(array(
            'controller' => 'controllers',
            'action' => 'list'
        ));
    }
}
