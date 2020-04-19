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

use Exception;
use PDOException;
use Phalcon\DevTools\Builder\Component\Scaffold;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Mvc\Controller\Base;
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
class ScaffoldController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setVar('page_title', 'Scaffold');
    }

    /**
     * @Route("/scaffold/generate", methods={"POST", "GET"}, name="scaffold-generate")
     *
     * @return ResponseInterface|void
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $tableName = $this->request->getPost('tableName', 'string');

                $options = [
                    'name'              => $tableName,
                    'schema'            => $this->request->getPost('schema', 'string'),
                    'force'             => $this->request->getPost('force', 'int'),
                    'genSettersGetters' => $this->request->getPost('genSettersGetters', 'int'),
                    'directory'         => $this->request->getPost('basePath', 'string'),
                    'templatePath'      => $this->request->getPost('templatesPath', 'string'),
                    'templateEngine'    => $this->request->getPost('templateEngine', 'string'),
                    'modelsNamespace'   => $this->request->getPost('modelsNamespace', 'string'),
                ];
                $scaffoldBuilder = new Scaffold(array_merge($options, ['config' => $this->config->toArray()]));
                $scaffoldBuilder->build();

                $this->flashSession->success(
                    sprintf('Scaffold for table "%s" was generated successfully', Text::camelize($tableName))
                );

                return $this->response->redirect('/webtools.php/migrations/list');
            } catch (BuilderException $e) {
                $this->flashSession->error($e->getMessage());
            } catch (Exception $e) {
                $this->flashSession->error($e->getMessage());
            }
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;
        $templatesPath = $this->registry->offsetGet('directories')->templatesPath;

        if (!$modelsDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the models directory is. " .
                "Please add to <code>application</code> section <code>modelsDir</code> param with real path."
            );
        }

        if (!$controllersDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the controllers directory is. " .
                "Please add to <code>application</code> section <code>controllersDir</code> param with real path."
            );
        }

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('controllersDir', $controllersDir);
        $this->tag->setDefault('modelsDir', $modelsDir);
        $this->tag->setDefault('templatesPath', $templatesPath);
        $this->tag->setDefault('schema', $this->dbUtils->resolveDbSchema());

        try {
            $tables = $this->dbUtils->listTables();
        } catch (PDOException $PDOException) {
            $tables = [];
            $this->flashSession->error($PDOException->getMessage());
        }

        $this->view->setVars([
            'page_subtitle'   => 'Generate code from template',
            'tables'          => $tables,
            'template_path'   => $templatesPath,
            'templateEngines' => [
                'volt' => 'Volt',
                'php'  => 'PHP',
            ],
        ]);
    }
}
