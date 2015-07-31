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

use Phalcon\Web\Tools;
use Phalcon\Builder\Path;
use Phalcon\Mvc\Controller;
use Phalcon\Exception;

/**
 * @property \Phalcon\Flash\Direct flash
 * @property \Phalcon\Mvc\View view
 * @property \Phalcon\Http\Request request
 * @property \Phalcon\Mvc\Dispatcher dispatcher
 * @property \Phalcon\Tag tag
 */
class ControllerBase extends Controller
{
    /**
     * Get file owner/group closure
     * @var closure
     */
    protected $fileOwner = null;

    /**
     * Models Dir
     * @var string|null
     */
    protected $modelsDir = null;

    /**
     * Controllers Dir
     * @var string|null
     */
    protected $controllersDir = null;

    /**
     * Migrations Dir
     * @var string|null
     */
    protected $migrationsDir = null;

    /**
     * Path component
     * @var Path
     */
    protected $path = null;

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize()
    {
        $this->checkAccess();

        $this->path = new Path();

        $this->fileOwner = function (DirectoryIterator $file) {
            // Windows, fallback, etc.
            $userName = getenv('USERNAME') ?: getenv('USER');

            if (function_exists('posix_getpwuid')) {
                $owner = posix_getpwuid($file->getOwner());
                $group = posix_getgrgid($file->getGroup());
                $userName = isset($owner['name']) ? $owner['name'] : '-?-';
                $groupName = isset($group['name']) ? $group['name'] : '-?-';

                $userName = $userName . ' / ' . $groupName;
            }

            return $userName;
        };

        $this->initDirs();
    }

    /**
     * Check remote IP address to disable remote activity
     *
     * @return boolean
     * @throws \Phalcon\Exception if connected remotely
     */
    protected function checkAccess()
    {
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;

        if ($ip && ($ip == '127.0.0.1' || $ip == '::1' || $this->checkToolsIp($ip))) {
            return true;
        }

        throw new Exception('WebTools can only be used on the local machine (Your IP: ' . $ip . ') or you can make changes in webtools.config.php file to allow IP or NET');
    }

    /**
     * List database tables
     *
     * @param  bool $all
     * @return void
     */
    protected function listTables($all = false)
    {
        $config = Tools::getConfig();
        $connection = Tools::getConnection();

        if ($all) {
            $tables = array('all' => 'All');
        } else {
            $tables = array();
        }

        $dbTables = $connection->listTables();
        foreach ($dbTables as $dbTable) {
            $tables[$dbTable] = $dbTable;
        }

        $this->view->tables = $tables;

        $this->view->databaseName = $config->database->dbname;

        if ($this->migrationsDir) {
            $this->view->migrationsDir = $this->migrationsDir;
        } else {
            $this->view->migrationsDir = null;
        }
    }

    /**
     * Check if IP address for securing Phalcon Developers Tools area matches
     * the given
     *
     * @param  string $ip
     * @return bool
     */
    private function checkToolsIp($ip)
    {
        return strpos($ip, Tools::getToolsIp()) === 0;
    }

    /**
     * Check if a path is absolute
     *
     * @param string $path Path to check
     *
     * @return bool
     */
    public function isAbsolutePath($path)
    {
        return $this->path->isAbsolutePath($path);
    }

    /**
     * Initialize system dirs
     *
     * @return $this
     */
    protected function initDirs()
    {
        $config = Tools::getConfig()->offsetGet('application');

        $dirs = array('modelsDir', 'controllersDir', 'migrationsDir');
        $this->path->setRootPath(dirname($_SERVER["SCRIPT_FILENAME"]));
        $projectPath = $this->path->getRootPAth();

        foreach ($dirs as $dirName) {
            if (isset($config[$dirName]) && $config[$dirName]) {
                if ($this->isAbsolutePath($config[$dirName])) {
                    $path = $config[$dirName];
                } else {
                    $path = $projectPath . $config[$dirName];
                }

                $path = rtrim($path, '\\/') . DIRECTORY_SEPARATOR;

                if (file_exists($path)) {
                    $this->{$dirName} = $path;
                }
            }
        }

        return $this;
    }
}
