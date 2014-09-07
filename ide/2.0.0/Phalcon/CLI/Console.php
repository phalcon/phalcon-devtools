<?php 

namespace Phalcon\CLI {    class Console implements \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
    {

        protected $_dependencyInjector;

        protected $_eventsManager;

        protected $_modules;

        protected $_moduleObject;

        public function __construct($dependencyInjector=null)
        {
        }


        public function setDI($dependencyInjector)
        {
        }


        public function getDI()
        {
        }


        public function setEventsManager($eventsManager)
        {
        }


        public function getEventsManager()
        {
        }


        public function registerModules($modules)
        {
        }


        public function addModules($modules)
        {
        }


        public function getModules()
        {
        }


        public function handle($arguments=null)
        {
        }

    }
}
