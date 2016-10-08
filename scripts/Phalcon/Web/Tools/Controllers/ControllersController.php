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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace WebTools\Controllers;

use DirectoryIterator;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Controller\Base;
use Phalcon\Builder\BuilderException;
use Phalcon\Mvc\Controller\CodemirrorTrait;
use Phalcon\Builder\Controller as ControllerBuilder;

/**
 * \WebTools\Controllers\ControllersController
 *
 * @package WebTools\Controllers
 */
class ControllersController extends Base
{
    use CodemirrorTrait;

    /**
     * Initialize controller
     */
    public function initialize()
    {
        parent::initialize();

        $this->view->setVar('page_title', 'Controllers');
    }

    /**
     * @Get("/controllers/list", name="controllers-list")
     */
    public function indexAction()
    {
        $controllers = [];

        if ($controllersDir = $this->registry->offsetGet('directories')->controllersDir) {
            foreach (new DirectoryIterator($controllersDir) as $file) {
                if ($file->isDot() || $file->isDir()) {
                    continue;
                }

                $controllers[] = (object) [
                    'name'          => $file->getBasename('.php'),
                    'filename'      => $file->getFilename(),
                    'size'          => $file->getSize(),
                    'owner'         => $this->fs->getOwner($file),
                    'modified_time' => date('D, d M y H:i:s', $file->getMTime()),
                    'is_writable'   => $file->isWritable(),
                ];
            }
        }

        $this->view->setVars(
            [
                'page_subtitle'   => 'All controllers that we managed to find',
                'controllers'     => $controllers,
                'controllers_dir' => $controllersDir,
            ]
        );
    }

    /**
     * @Get("/controllers/edit/{file:[\w\d_.~%-]+}", name="controllers-edit")
     * @param string $file
     */
    public function editAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flash->error('Controller could not be found.');
            $this->dispatcher->forward([
                'controller' => 'controllers',
                'action'     => 'index',
            ]);
            return;
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $path = $this->fs->normalize("{$controllersDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flash->error('Controller could not be found.');
            $this->dispatcher->forward([
                'controller' => 'controllers',
                'action'     => 'index',
            ]);
            return;
        }

        $this->registerResources();

        if (!is_writable($path)) {
            $this->flash->error(sprintf('You have not enough rights to edit %s using a browser.', $fileName));
            $this->dispatcher->forward([
                'controller' => 'controllers',
                'action'     => 'view',
                'params'     => [$fileName],
            ]);
            return;
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->tag->setDefault('path', $path);

        $this->view->setVars(
            [
                'page_subtitle'   => 'Editing Controller',
                'controller_path' => $controllersDir,
                'controller_name' => $fileName,
                'custom_css'      => true,
            ]
        );
    }

    /**
     * @Get("/controllers/view/{file:[\w\d_.~%-]+}", name="controllers-view")
     * @param string $file
     */
    public function viewAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flash->error('Controller could not be found.');
            $this->dispatcher->forward([
                'controller' => 'controllers',
                'action'     => 'index',
            ]);
            return;
        }

        $this->registerResources();

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $path = $this->fs->normalize("{$controllersDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flash->error('Controller could not be found.');
            $this->dispatcher->forward([
                'controller' => 'controllers',
                'action'     => 'index',
            ]);
            return;
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->view->setVars(
            [
                'page_subtitle'   => 'View Controller',
                'controller_path' => $controllersDir,
                'controller_name' => $fileName,
                'custom_css'      => true,
            ]
        );
    }

    /**
     * @Route("/controllers/update", methods={"POST", "PUT"}, name="controllers-save")
     */
    public function updateAction()
    {
        if (!$this->request->has('path') || !$this->request->has('code')) {
            $this->flashSession->error('Wrong form data.');
            return $this->response->redirect('/webtools.php?_url=/controllers/list');
        }

        $path = $this->request->getPost('path', 'string');
        $code = $this->request->getPost('code');

        if (!file_exists($path)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php?_url=/controllers/list');
        }

        $controllerName = basename($path, '.php');

        if (!is_writable($path)) {
            $this->flashSession->error(
                sprintf('You have not enough rights to edit %s using a browser.', $controllerName)
            );
            return $this->response->redirect('/webtools.php?_url=/controllers/list');
        }

        if (false === file_put_contents($path, $code, LOCK_EX)) {
            $this->flashSession->error(sprintf('Unable to save %s controller.', $controllerName));
        } else {
            $this->flashSession->success(sprintf('The controller "%s" was saved successfully.', $controllerName));
        }

        return $this->response->redirect('/webtools.php?_url=/controllers/list');
    }

    /**
     * @Route("/controllers/generate", methods={"POST", "GET"}, name="controllers-generate")
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $controllerBuilder = new ControllerBuilder(
                    [
                        'name'           => $this->request->getPost('name', 'string'),
                        'basePath'       => $this->request->getPost('basePath', 'string'),
                        'namespace'      => $this->request->getPost('namespace', 'string'),
                        'baseClass'      => $this->request->getPost('baseClass', 'string'),
                        'force'          => $this->request->getPost('force', 'int'),
                        'controllersDir' => $this->request->getPost('controllersDir', 'string')
                    ]
                );

                $fileName = $controllerBuilder->build();

                $this->flashSession->success(
                    sprintf('Controller "%s" was created successfully', str_replace('.php', '', $fileName))
                );

                return $this->response->redirect('/webtools.php?_url=/controllers/list');
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flash->error('An unexpected error has occurred.');
            }
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;
        $controllerName = $this->request->getPost('name', 'string', 'New');

        if (!$controllersDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where the controllers directory is. " .
                "Please add to <code>application</code> section <code>controllersDir</code> param with real path."
            );
        }

        $this->tag->setDefault('name', $controllerName);
        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('baseClass', '\\' . Controller::class);
        $this->tag->setDefault('controllersDir', $controllersDir);

        $this->view->setVars(
            [
                'page_subtitle'   => 'Generate Controller',
                'controller_path' => $controllersDir,
                'controller_name' => basename($controllerName, 'Controller.php') . 'Controller.php'
            ]
        );
    }
}
