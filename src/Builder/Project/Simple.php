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

namespace Phalcon\DevTools\Builder\Project;

use Phalcon\DevTools\Builder\Component\Controller as ControllerBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Web\Tools;
use Phalcon\Exception;

/**
 * Builder to create Simple application skeletons
 */
class Simple extends ProjectBuilder
{
    use ProjectAware;

    /**
     * Project directories
     *
     * @var array
     */
    protected $projectDirectories = [
        'app',
        'app/views',
        'app/config',
        'app/models',
        'app/controllers',
        'app/library',
        'app/migrations',
        'app/views/index',
        'app/views/layouts',
        'cache',
        'public',
        'public/img',
        'public/css',
        'public/temp',
        'public/files',
        'public/js',
        '.phalcon'
    ];

    /**
     * Build project
     *
     * @return bool
     * @throws BuilderException
     * @throws Exception
     */
    public function build()
    {
        
        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createBootstrapFiles()
            ->createHtaccessFiles()
            ->createControllerBase()
            ->createIndexViewFiles()
            ->createControllerFile()
            ->createHtrouterFile();

        if ($this->options->has('enableWebTools') && true === $this->options->get('enableWebTools')) {
            Tools::install($this->options->get('projectPath'));
        }

        return true;
    }

    /**
     * Create indexController file
     *
     * @return $this
     * @throws BuilderException
     */
    private function createControllerFile()
    {
        $builder = new ControllerBuilder([
            'name' => 'index',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/controllers',
            'baseClass' => 'ControllerBase'
        ]);

        $builder->build();

        return $this;
    }

    /**
     * Create view files by default
     *
     * @return $this
     */
    private function createIndexViewFiles()
    {
        $engine = $this->options->get('templateEngine') == 'volt' ? 'volt' : 'phtml';

        $getFile = $this->options->get('templatePath') . '/project/simple/views/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/views/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/simple/views/index/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/views/index/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Create ControllerBase
     *
     * @return $this
     */
    private function createControllerBase()
    {
        $getFile = $this->options->get('templatePath') . '/project/simple/ControllerBase.php';
        $putFile = $this->options->get('projectPath') . 'app/controllers/ControllerBase.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create .htaccess files by default of application
     *
     * @return $this
     */
    private function createHtaccessFiles()
    {
        if (file_exists($this->options->get('projectPath') . '.htaccess') == false) {
            $code = '<IfModule mod_rewrite.c>' . PHP_EOL .
                "\t" . 'RewriteEngine on' . PHP_EOL .
                "\t" . 'RewriteRule  ^$ public/    [L]' . PHP_EOL .
                "\t" . 'RewriteRule  (.*) public/$1 [L]' . PHP_EOL .
                '</IfModule>';
            file_put_contents($this->options->get('projectPath') . '.htaccess', $code);
        }

        if (file_exists($this->options->get('projectPath') . 'public/.htaccess') == false) {
            file_put_contents(
                $this->options->get('projectPath') . 'public/.htaccess',
                file_get_contents($this->options->get('templatePath') . '/project/simple/htaccess')
            );
        }

        if (file_exists($this->options->get('projectPath') . 'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1>' .
                '<p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($this->options->get('projectPath') . 'index.html', $code);
        }

        return $this;
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createBootstrapFiles()
    {
        $getFile = $this->options->get('templatePath') . '/project/simple/index.php';
        $putFile = $this->options->get('projectPath') . 'public/index.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->get('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/simple/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/simple/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/simple/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/simple/router.php';
        $putFile = $this->options->get('projectPath') . 'app/config/router.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }
}
