<?php

namespace Phalcon\Commands\Builtin;

use Phalcon\Commands\Command;
use Phalcon\Script\Color;
use Phalcon\Builder\Xiapi as XiapiBuilder;

class Xiapi extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'name=s'            => 'Name of the new project',
            'enable-webtools'   => 'Determines if webtools should be enabled [optional]',
            'directory=s'       => 'Base path on which project will be created [optional]',
            'template-path=s'   => 'Specify a template path [optional]',
            'template-engine=s' => 'Define the template engine, default phtml (phtml, volt) [optional]',
            'trace'             => 'Shows the trace of the framework in case of exception [optional]',
            'help'              => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters)
    {
        $projectName    = $this->getOption(['name', 1], null, 'xiapi_demo');
        $projectPath    = $this->getOption(['directory', 3]);
        $templatePath   = $this->getOption(['template-path'], null, TEMPLATE_PATH);
        $enableWebtools = $this->getOption(['enable-webtools', 4], null, false);

        $builder = new XiapiBuilder([
            'name'           => $projectName,
            'directory'      => $projectPath,
            'enableWebTools' => $enableWebtools,
            'templatePath'   => $templatePath,
        ]);

        return $builder->build();
    }


    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['xiapi', 'create-xiapi'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a project') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  project [name] [type] [directory] [enable-webtools]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        print Color::head('Example') . PHP_EOL;
        print Color::colorize('  phalcon project store simple', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}