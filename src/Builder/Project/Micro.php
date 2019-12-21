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

/**
 * Builder to create Micro application skeletons
 */
class Micro extends ProjectBuilder
{
    /**
     * Project directories
     *
     * @var array
     */
    protected $projectDirectories = [
        'app',
        'app/config',
        'app/models',
        'app/views',
        'app/migrations',
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
     */
    public function build()
    {
        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createBootstrapFile()
            ->createHtaccessFiles()
            ->createIndexViewFiles();

        return true;
    }

    /**
     * Create view files by default
     *
     * @return $this
     */
    private function createIndexViewFiles()
    {
        $engine = $this->options->get('templateEngine') == 'volt' ? 'volt' : 'phtml';

        $getFile = $this->options->get('templatePath') . '/project/micro/views/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/views/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/micro/views/404.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/views/404.' . $engine;
        $this->generateFile($getFile, $putFile);

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
                file_get_contents($this->options->get('templatePath') . '/project/micro/htaccess')
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
    private function createBootstrapFile()
    {
        $getFile = $this->options->get('templatePath') . '/project/micro/index.php';
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

        $getFile = $this->options->get('templatePath') . '/project/micro/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/micro/app.php';
        $putFile = $this->options->get('projectPath') . 'app/app.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }
}
