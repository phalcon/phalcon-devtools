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
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Mvc\Controller\Base;
use Phalcon\Flash\Session;
use Phalcon\Http\ResponseInterface;
use Phalcon\Migrations\Migrations;
use Phalcon\Tag;

/**
 * @property Session $flashSession
 * @property Tag $tag
 */
class MigrationsController extends Base
{
    /**
     * Initialize controller
     */
    public function initialize()
    {
        $this->view->setVar('page_title', 'Migrations');
    }

    /**
     * @Get("/migrations/list", name="migrations-list")
     */
    public function indexAction(): void
    {
        $migrations = [];

        if ($migrationsDir = $this->registry->offsetGet('directories')->migrationsDir) {
            foreach (new DirectoryIterator($migrationsDir) as $index => $version) {
                if ($version->isDot() || !$version->isDir()) {
                    continue;
                }

                foreach (new DirectoryIterator($version->getPathname()) as $file) {
                    if ($file->isDot() || $file->isDir() || 'php' !== strtolower($file->getExtension())) {
                        continue;
                    }

                    $migrations[$version->getBasename()][] = (object) [
                        'name'          => substr($file->getFilename(), 0, -strlen($file->getExtension()) - 1),
                        'filename'      => $file->getFilename(),
                        'size'          => $file->getSize(),
                        'owner'         => $this->fs->getOwner($file),
                        'modified_time' => date('D, d M y H:i:s', $file->getMTime()),
                        'is_writable'   => $file->isWritable(),
                    ];
                }
            }
        }

        if (!empty($migrations)) {
            $keys = array_keys($migrations);
            natsort($keys);

            $tmp = $migrations;
            $migrations = [];
            foreach ($keys as $v) {
                $migrations[$v] = $tmp[$v];
            }
        }

        $this->view->setVars(
            [
                'migrations'     => $migrations,
                'migrations_dir' => $migrationsDir,
            ]
        );
    }

    /**
     * @Route("/migrations/generate", methods={"POST", "GET"}, name="migrations-generate")
     *
     * @return ResponseInterface|void
     */
    public function generateAction()
    {
        if ($this->request->isPost()) {
            try {
                Migrations::generate([
                    'directory'       => $this->request->getPost('basePath', 'string'),
                    'tableName'       => $this->request->getPost('tableName', 'string'),
                    'exportData'      => $this->request->getPost('exportDataType', 'string'),
                    'migrationsDir'   => $this->request->getPost('migrationsDir', 'string'),
                    'force'           => $this->request->getPost('force', 'int'),
                    'noAutoIncrement' => $this->request->getPost('noAi', 'int'),
                    'config'          => $this->config,
                    'descr'           => null, // @todo
                    'version'         => $this->request->getPost('version', 'string'),
                ]);

                $this->flashSession->success('The migration was generated successfully.');

                return $this->response->redirect('/webtools.php/migrations/list');
            } catch (BuilderException $e) {
                $this->flashSession->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flashSession->error('An unexpected error has occurred. ' . $e->getMessage());
            }
        }

        $migrationsDir = $this->registry->offsetGet('directories')->migrationsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;

        if (!$migrationsDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the migrations directory is. " .
                "Please add to <code>application</code> section <code>migrationsDir</code> param with real path."
            );
        }

        $this->prepareVersions();

        try {
            $tables = $this->dbUtils->listTables(true);
        } catch (PDOException $PDOException) {
            $tables = [];
            $this->flashSession->error($PDOException->getMessage());
        }

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('migrationsDir', $migrationsDir);

        $this->view->setVars(
            [
                'migration_path' => $migrationsDir,
                'tables'         => $tables,
            ]
        );
    }

    /**
     * @Route("/migrations/run", methods={"POST", "GET"}, name="migrations-run")
     *
     * @return ResponseInterface|void
     */
    public function runAction()
    {
        if ($this->request->isPost()) {
            try {
                Migrations::run(
                    [
                        'config'        => $this->config,
                        'directory'     => $this->request->getPost('basePath', 'string'),
                        'tableName'     => '@', // @todo
                        'migrationsDir' => $this->request->getPost('migrationsDir', 'string'),
                    ]
                );

                $this->flashSession->success('The migration was executed successfully.');

                return $this->response->redirect('/webtools.php/migrations/list');
            } catch (BuilderException $e) {
                $this->flashSession->error($e->getMessage());
            } catch (\Exception $e) {
                $this->flashSession->error('An unexpected error has occurred. ' . $e->getMessage());
            }
        }

        $migrationsDir = $this->registry->offsetGet('directories')->migrationsDir;
        $basePath = $this->registry->offsetGet('directories')->basePath;

        if (!$migrationsDir) {
            $this->flashSession->error(
                "Sorry, WebTools doesn't know where the migrations directory is. " .
                "Please add to <code>application</code> section <code>migrationsDir</code> param with real path."
            );
        }

        $this->prepareVersions();

        $this->tag->setDefault('basePath', $basePath);
        $this->tag->setDefault('migrationsDir', $migrationsDir);

        $this->view->setVars(
            [
                'migration_path' => $migrationsDir,
            ]
        );
    }

    protected function prepareVersions(): void
    {
        $migrationsDir = $this->registry->offsetGet('directories')->migrationsDir;

        if (!$migrationsDir || !is_dir($migrationsDir) || !is_readable($migrationsDir)) {
            $this->tag->setDefault('oldVersion', 'None');
            return;
        }

        $folders = [];
        $iterator = new DirectoryIterator($migrationsDir);
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDot() || !$fileinfo->isDir()) {
                continue;
            }

            $folders[$fileinfo->getFilename()] = $fileinfo->getFilename();
        }

        natsort($folders);
        $folders = array_reverse($folders);
        $foldersKeys = array_keys($folders);

        if (isset($foldersKeys[0])) {
            $this->tag->setDefault('oldVersion', $foldersKeys[0]);
        } else {
            $this->tag->setDefault('oldVersion', 'None');
        }
    }
}
