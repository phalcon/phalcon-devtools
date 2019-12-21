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
use PDOException;
use Phalcon\DevTools\Builder\Component\AllModels;
use Phalcon\DevTools\Builder\Component\Model;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Mvc\Controller\Base;
use Phalcon\DevTools\Mvc\Controller\CodemirrorTrait;
use Phalcon\Flash\Session;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\DispatcherInterface;
use Phalcon\Tag;
use Phalcon\Text;

/**
 * @property Dispatcher|DispatcherInterface $dispatcher
 * @property Tag $tag
 * @property Session $flashSession
 */
class ModelsController extends Base
{
    use CodemirrorTrait;

    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setVar('page_title', 'Models');
    }

    /**
     * @Get("/models/list", name="models-list")
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

        $this->view->setVars([
            'models'        => $models,
            'models_dir'    => $modelsDir,
        ]);
    }

    /**
     * @Get("/models/edit/{file:[\w\d_.~%-]+}", name="models-edit")
     *
     * @param string $file
     * @return ResponseInterface|void
     */
    public function editAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $path = $this->fs->normalize("{$modelsDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $this->registerResources();

        if (!is_writable($path)) {
            $this->flashSession->error(sprintf('You have not enough rights to edit %s using a browser.', $fileName));
            return $this->response->redirect('/webtools.php/models/edit/' . $fileName);
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->tag->setDefault('path', $path);

        $this->view->setVars([
            'page_subtitle'=> 'Editing Model',
            'model_path'   => $modelsDir,
            'model_name'   => $fileName,
            'custom_css'   => true,
        ]);
    }

    /**
     * @Get("/models/view/{file:[\w\d_.~%-]+}", name="models-view")
     *
     * @param string $file
     * @return ResponseInterface|void
     */
    public function viewAction($file)
    {
        if (empty($file) || !$fileName = rawurldecode($file)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $this->registerResources();

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $path = $this->fs->normalize("{$modelsDir}/{$fileName}");

        if (!file_exists($path)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $this->tag->setDefault('code', file_get_contents($path));
        $this->view->setVars([
            'page_subtitle' => 'View Model',
            'model_path'    => $modelsDir,
            'model_name'    => $fileName,
            'custom_css'    => true,
        ]);
    }

    /**
     * @Route("/models/update", methods={"POST", "PUT"}, name="models-save")
     *
     * @return ResponseInterface
     */
    public function updateAction()
    {
        if (!$this->request->has('path') || !$this->request->has('code')) {
            $this->flashSession->error('Wrong form data.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $path = $this->request->getPost('path', 'string');
        $code = $this->request->getPost('code');

        if (!file_exists($path)) {
            $this->flashSession->error('Model could not be found.');
            return $this->response->redirect('/webtools.php/models/list');
        }

        $modelName = basename($path, '.php');

        if (!is_writable($path)) {
            $this->flashSession->error(sprintf('You have not enough rights to edit %s using a browser.', $modelName));
            return $this->response->redirect('/webtools.php/models/list');
        }

        if (false === file_put_contents($path, $code, LOCK_EX)) {
            $this->flashSession->error(sprintf('Unable to save %s model.', $modelName));
        } else {
            $this->flashSession->success(sprintf('The model "%s" was saved successfully.', $modelName));
        }

        return $this->response->redirect('/webtools.php/models/list');
    }

    /**
     * @Route("/models/generate", methods={"POST", "GET"}, name="models-generate")
     *
     * @return ResponseInterface|void
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $tableName = $this->request->getPost('tableName', 'string');
                $component = '@' == $tableName ? AllModels::class : Model::class;

                /** @var AllModels $modelBuilder */
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
                    'mapColumn'             => $this->request->getPost('mapcolumn', 'int'),
                    'config'                => $this->config,
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

                return $this->response->redirect('/webtools.php/models/list');
            } catch (BuilderException $e) {
                $this->flashSession->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flashSession->error(sprintf('An unexpected error has occurred: %s', $e->getMessage()));
            }
        }

        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;

        if (!$modelsDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the models directory is. " .
                "Please add to <code>application</code> section <code>modelsDir</code> param with real path."
            );
        }

        try {
            $tables = $this->dbUtils->listTables(true);
        } catch (PDOException $PDOException) {
            $tables = [];
            $this->flashSession->error($PDOException->getMessage());
        }

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('schema', $this->dbUtils->resolveDbSchema());
        $this->tag->setDefault('modelsDir', $modelsDir);

        $this->view->setVars([
            'model_path'    => $modelsDir,
            'tables'        => $tables,
        ]);
    }
}
