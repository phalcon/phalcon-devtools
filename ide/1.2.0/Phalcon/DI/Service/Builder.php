<?php 

namespace Phalcon\DI\Service {

	/**
	 * Phalcon\DI\Service\Builder
	 *
	 * This class builds instances based on complex definitions
	 */
	
	class Builder {

		/**
		 * Resolves a constructor/call parameter
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param int $position
		 * @param array $argument
		 * @return mixed
		 */
		protected function _buildParameter(){ }


		/**
		 * Resolves an array of parameters
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param array $arguments
		 * @return array
		 */
		protected function _buildParameters(){ }


		/**
		 * Builds a service using a complex service definition
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param array $definition
		 * @param array $parameters
		 * @return mixed
		 */
		public function build($dependencyInjector, $definition, $parameters=null){ }

	}
}
