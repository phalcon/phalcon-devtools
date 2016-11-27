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

use Phalcon\Text;
use Phalcon\Config;
use DirectoryIterator;
use Phalcon\Builder\Model;
use Phalcon\Builder\AllModels;
use Phalcon\Mvc\Controller\Base;
use Phalcon\Builder\BuilderException;
use Phalcon\Mvc\Controller\CodemirrorTrait;

/**
 * \WebTools\Controllers\ModelsController
 *
 * @package WebTools\Controllers
 */
class ModelsController extends Base
{
    use CodemirrorTrait;

    /**
     * Initialize controller
     */
    public function initialize()
    {
        parent::initialize();

        $this->view->setVar('page_title', 'Models');
    }

    /**
     * @Get("/models/list", name="models-list")
     *
     */
    public function indexAction()
    {
        $models = [];

        if ($modelsDir = $this->registry->offsetGet('directories')->modelsDir) {
            foreach (new DirectoryIterator($modelsDir) as $file) {
                if ($file->isDot() || $file->isDir()) {
                    continue;
                }

                $models[] = (object) [
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
                'page_subtitle' => 'All models that we managed to find',
                'models'        => $models,
                'models_dir'    => $modelsDir,
            ]
        );
    }

    /**
     * @Get("/models/edit/{file:[\w\d_.~%-]+}", name="models-edit")
     * @param string $file
     */
    public function editAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flash->error('Model could not be found.');
            $this->dispatcher->forward([
                'controller' => 'models',
                'action'     => 'index',
            ]);
            return;
        }

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $path = $this->fs->normalize("{$modelsDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flash->error('Model could not be found.');
            $this->dispatcher->forward([
                'controller' => 'models',
                'action'     => 'index',
            ]);
            return;
        }

        $this->registerResources();

        if (!is_writable($path)) {
            $this->flash->error(sprintf('You have not enough rights to edit %s using a browser.', $fileName));
            $this->dispatcher->forward([
                'controller' => 'models',
                'action'     => 'view',
                'params'     => [$fileName],
            ]);
            return;
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->tag->setDefault('path', $path);

        $this->view->setVars(
            [
                'page_subtitle'=> 'Editing Model',
                'model_path'   => $modelsDir,
                'model_name'   => $fileName,
                'custom_css'   => true,
            ]
        );
    }

    /**
     * @Get("/models/view/{file:[\w\d_.~%-]+}", name="models-view")
     * @param string $file
     */
    public function viewAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flash->error('Model could not be found.');
            $this->dispatcher->forward([
                'controller' => 'models',
                'action'     => 'index',
            ]);
            return;
        }

        $this->registerResources();

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $path = $this->fs->normalize("{$modelsDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flash->error('Model could not be found.');
            $this->dispatcher->forward([
                'controller' => 'models',
                'action'     => 'index',
            ]);
            return;
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->view->setVars(
            [
                'page_subtitle' => 'View Model',
                'model_path'    => $modelsDir,
                'model_name'    => $fileName,
                'custom_css'    => true,
            ]
        );
    }

    /**
     * @Route("/models/update", methods={"POST", "PUT"}, name="models-save")
     */
    public function updateAction()
    {
        if (!$this->request->has('path') || !$this->request->has('code')) {
            $this->flashSession->error('Wrong form data.');
            return $this->response->redirect('/webtools.php?_url=/models/list');
        }

        $path = $this->request->getPost('path', 'string');
        $code = $this->request->getPost('code');

        if (!file_exists($path)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php?_url=/models/list');
        }

        $modelName = basename($path, '.php');

        if (!is_writable($path)) {
            $this->flashSession->error(sprintf('You have not enough rights to edit %s using a browser.', $modelName));
            return $this->response->redirect('/webtools.php?_url=/models/list');
        }

        if (false === file_put_contents($path, $code, LOCK_EX)) {
            $this->flashSession->error(sprintf('Unable to save %s model.', $modelName));
        } else {
            $this->flashSession->success(sprintf('The model "%s" was saved successfully.', $modelName));
        }

        return $this->response->redirect('/webtools.php?_url=/models/list');
    }

    /**
     * @Route("/models/generate", methods={"POST", "GET"}, name="models-generate")
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $tableName = $this->request->getPost('tableName', 'string');
                $component = '@' == $tableName ? AllModels::class : Model::class;

                /** @var  Model|AllModels $modelBuilder */
                $modelBuilder = new $component([
                    'name'                  => $tableName,
                    'force'                 => $this->request->getPost('force', 'int'),
                    'modelsDir'             => $this->request->getPost('modelsDir', 'string'),
                    'directory'             => $this->request->getPost('basePath', 'string'),
                    'foreignKeys'           => $this->request->getPost('foreignKeys', 'int'),
                    'defineRelations'       => $this->request->getPost('defineRelations', 'int'),
                    'genSettersGetters'     => $this->request->getPost('genSettersGetters', 'int'),
                    'namespace'             => $this->request->getPost('namespace', 'string'),
                    'schema'                => $this->request->getPost('schema', 'string'),
                    'mapColumn'             => $this->request->getPost('mapcolumn', 'int')
                ]);

                $modelBuilder->build();

                if ($tableName == '@') {
                    if (($n = count($modelBuilder->exist)) > 0) {
                        $mList = implode('</strong>, <strong>', $modelBuilder->exist);

                        $notice = sprintf(
                            'Model%s <strong>%s</strong> %s already exists!',
                            1 === $n ? '' : 's',
                            $mList,
                            1 === $n ? 'was skipped because it' : 'were skipped because they'
                        );

                        $this->flashSession->notice($notice);
                    }

                    $message = 'Models were created successfully.';
                } else {
                    $message = sprintf(
                        'Model "%s" was created successfully',
                        Text::camelize(basename($tableName, '.php'))
                    );
                }

                $this->flashSession->success($message);

                return $this->response->redirect('/webtools.php?_url=/models/list');
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flash->error(
                    sprintf('An unexpected error has occurred: %s', $e->getMessage())
                );
            }
        }

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;

        if (!$modelsDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where the models directory is. " .
                "Please add to <code>application</code> section <code>modelsDir</code> param with real path."
            );
        }

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('schema', $this->dbUtils->resolveDbSchema());
        $this->tag->setDefault('modelsDir', $modelsDir);

        $this->view->setVars(
            [
                'page_subtitle' => 'Generate Model',
                'model_path'    => $modelsDir,
                'tables'        => $this->dbUtils->listTables(true),
            ]
        );
    }
}
