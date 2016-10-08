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
use Phalcon\Builder\Scaffold;
use Phalcon\Mvc\Controller\Base;
use Phalcon\Builder\BuilderException;

/**
 * \WebTools\Controllers\ScaffoldController
 *
 * @package WebTools\Controllers
 */
class ScaffoldController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        parent::initialize();

        $this->view->setVar('page_title', 'Scaffold');
    }

    /**
     * @Route("/scaffold/generate", methods={"POST", "GET"}, name="scaffold-generate")
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                $tableName = $this->request->getPost('tableName', 'string');

                $scaffoldBuilder = new Scaffold([
                    'name'              => $tableName,
                    'schema'            => $this->request->getPost('schema', 'string'),
                    'force'             => $this->request->getPost('force', 'int'),
                    'genSettersGetters' => $this->request->getPost('genSettersGetters', 'int'),
                    'directory'         => $this->request->getPost('basePath', 'string'),
                    'templatePath'      => $this->request->getPost('templatesPath', 'string'),
                    'templateEngine'    => $this->request->getPost('templateEngine', 'string'),
                    'modelsNamespace'   => $this->request->getPost('modelsNamespace', 'string'),
                ]);

                $scaffoldBuilder->build();

                $this->flashSession->success(
                    sprintf('Scaffold for table "%s" was generated successfully', Text::camelize($tableName))
                );

                return $this->response->redirect('/webtools.php?_url=/migrations/list');
            } catch (BuilderException $e) {
                $this->flash->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flash->error('An unexpected error has occurred.');
            }
        }

        $controllersDir = $this->registry->offsetGet('directories')->controllersDir;
        $modelsDir = $this->registry->offsetGet('directories')->modelsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;
        $templatesPath = $this->registry->offsetGet('directories')->templatesPath;

        if (!$modelsDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where the models directory is. " .
                "Please add to <code>application</code> section <code>modelsDir</code> param with real path."
            );
        }

        if (!$controllersDir) {
            $this->flash->error(
                "Sorry, WebTools doesn't know where the controllers directory is. " .
                "Please add to <code>application</code> section <code>controllersDir</code> param with real path."
            );
        }

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('controllersDir', $controllersDir);
        $this->tag->setDefault('modelsDir', $modelsDir);
        $this->tag->setDefault('templatesPath', $templatesPath);
        $this->tag->setDefault('schema', $this->dbUtils->resolveDbSchema());

        $this->view->setVars(
            [
                'page_subtitle'   => 'Generate code from template',
                'tables'          => $this->dbUtils->listTables(),
                'template_path'   => $templatesPath,
                'templateEngines' => [
                    'volt' => 'Volt',
                    'php'  => 'PHP',
                ],
            ]
        );
    }
}
