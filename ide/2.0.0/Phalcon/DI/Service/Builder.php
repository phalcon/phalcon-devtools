<?php 

namespace Phalcon\Di\Service {

    /**
     * Phalcon\Di\Service\Builder
     *
     * This class builds instances based on complex definitions
     */
    class Builder
    {

        /**
         * Resolves a constructor/call parameter
         *
         * @param \Phalcon\DiInterface dependencyInjector
         * @param int position
         * @param array argument
         * @return mixed
         */
        private function _buildParameter($dependencyInjector, $position, $argument)
        {
        }


        /**
         * Resolves an array of parameters
         *
         * @param \Phalcon\DiInterface dependencyInjector
         * @param array arguments
         * @return array
         */
        private function _buildParameters($dependencyInjector, $arguments)
        {
        }


        /**
         * Builds a service using a complex service definition
         *
         * @param \Phalcon\DiInterface dependencyInjector
         * @param array definition
         * @param array parameters
         * @return mixed
         */
        public function build($dependencyInjector, $definition, $parameters=null)
        {
        }

    }
}
