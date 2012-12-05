<?php 

namespace Phalcon\Mvc\Collection {

	/**
	 * Phalcon\Mvc\Collection\Manager
	 *
	 * This components controls the initialization of models, keeping record of relations
	 * between the different models of the application.
	 *
	 * A CollectionManager is injected to a model via a Dependency Injector Container such as Phalcon\DI.
	 *
	 * <code>
	 * $dependencyInjector = new Phalcon\DI();
	 *
	 * $dependencyInjector->set('collectionManager', function(){
	 *      return new Phalcon\Mvc\Collection\Manager();
	 * });
	 *
	 * $robot = new Robots($dependencyInjector);
	 * </code>
	 */
	
	class Manager {

		protected $_initialized;

		/**
		 * \Phalcon\Mvc\Collection\Manager constructor
		 */
		public function __construct(){ }


		public function isInitialized($collection){ }


		public function initialize(){ }

	}
}
