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

namespace Phalcon\DevTools\Web\Tools\Controllers;

use DirectoryIterator;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Builder\Component\Controller as ControllerBuilder;
use Phalcon\DevTools\Mvc\Controller\Base;
use Phalcon\DevTools\Mvc\Controller\CodemirrorTrait;
use Phalcon\Flash\Session;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\DispatcherInterface;
use Phalcon\Tag;

/**
 * @property Dispatcher|DispatcherInterface $dispatcher
 * @property Tag $tag
 * @property Session $flashSession
 */
class ControllersController extends Base
{
    use CodemirrorTrait;

    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setVar('page_title', 'Controllers');
    }

    /**
     * @Get("/controllers/list", name="controllers-list")
     */
    public function indexAction(): void
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

        $this->view->setVars([
            'controllers'     => $controllers,
            'controllers_dir' => $controllersDir,
        ]);
    }

    /**
     * @Get("/controllers/edit/{file:[\w\d_.~%-]+}", name="controllers-edit")
     *
     * @param string $file
     * @return ResponseInterface|void
     */
    public function editAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $path = $this->fs->normalize("{$controllersDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $this->registerResources();

        if (!is_writable($path)) {
            $this->flashSession->error(sprintf('You have not enough rights to edit %s using a browser.', $fileName));
            return $this->response->redirect('/webtools.php/controllers/edit/' . $fileName);
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->tag->setDefault('path', $path);

        $this->view->setVars([
            'page_subtitle'   => 'Editing Controller',
            'controller_path' => $controllersDir,
            'controller_name' => $fileName,
            'custom_css'      => true,
        ]);
    }

    /**
     * @Get("/controllers/view/{file:[\w\d_.~%-]+}", name="controllers-view")
     *
     * @param string $file
     * @return ResponseInterface|void
     */
    public function viewAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $this->registerResources();

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $path = $this->fs->normalize("{$controllersDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->view->setVars([
            'page_subtitle'   => 'View Controller',
            'controller_path' => $controllersDir,
            'controller_name' => $fileName,
            'custom_css'      => true,
        ]);
    }

    /**
     * @Route("/controllers/update", methods={"POST", "PUT"}, name="controllers-save")
     *
     * @return ResponseInterface|void
     */
    public function updateAction()
    {
        if (!$this->request->has('path') || !$this->request->has('code')) {
            $this->flashSession->error('Wrong form data.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $path = $this->request->getPost('path', 'string');
        $code = $this->request->getPost('code');

        if (!file_exists($path)) {
            $this->flashSession->error('Controller could not be found.');
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        $controllerName = basename($path, '.php');

        if (!is_writable($path)) {
            $this->flashSession->error(
                sprintf('You have not enough rights to edit %s using a browser.', $controllerName)
            );
            return $this->response->redirect('/webtools.php/controllers/list');
        }

        if (false === file_put_contents($path, $code, LOCK_EX)) {
            $this->flashSession->error(sprintf('Unable to save %s controller.', $controllerName));
        } else {
            $this->flashSession->success(sprintf('The controller "%s" was saved successfully.', $controllerName));
        }

        return $this->response->redirect('/webtools.php/controllers/list');
    }

    /**
     * @Route("/controllers/generate", methods={"POST", "GET"}, name="controllers-generate")
     *
     * @return ResponseInterface|void
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $controllerBuilder = new ControllerBuilder([
                    'name'           => $this->request->getPost('name', 'string'),
                    'basePath'       => $this->request->getPost('basePath', 'string'),
                    'namespace'      => $this->request->getPost('namespace', 'string'),
                    'baseClass'      => $this->request->getPost('baseClass', 'string'),
                    'force'          => $this->request->getPost('force', 'int'),
                    'controllersDir' => $this->request->getPost('controllersDir', 'string')
                ]);

                $fileName = $controllerBuilder->build();

                $this->flashSession->success(
                    sprintf('Controller "%s" was created successfully', str_replace('.php', '', $fileName))
                );

                return $this->response->redirect('/webtools.php/controllers/list');
            } catch (BuilderException $e) {
                $this->flashSession->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flashSession->error('An unexpected error has occurred.');
            }
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;
        $controllerName = $this->request->getPost('name', 'string', 'New');

        if (!$controllersDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the controllers directory is. " .
                "Please add to <code>application</code> section <code>controllersDir</code> param with real path."
            );
        }

        $this->tag->setDefault('name', $controllerName);
        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('baseClass', '\\' . Controller::class);
        $this->tag->setDefault('controllersDir', $controllersDir);

        $this->view->setVars([
            'controller_path' => $controllersDir,
            'controller_name' => basename($controllerName, 'Controller.php') . 'Controller.php'
        ]);
    }
}
