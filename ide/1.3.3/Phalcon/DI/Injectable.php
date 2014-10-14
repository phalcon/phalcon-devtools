<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\Injectable
	 *
	 * This class allows to access services in the services container by just only accessing a public property
	 * with the same name of a registered service
	 */
	
	abstract class Injectable implements \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		/**
 		 * @var \Phalcon\Mvc\Dispatcher|\Phalcon\Mvc\DispatcherInterface
 		 */
		public $dispatcher;

		/**
 		 * @var \Phalcon\Mvc\Router|\Phalcon\Mvc\RouterInterface
 		 */
		public $router;

		/**
 		 * @var \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface
 		 */
		public $url;

		/**
 		 * @var \Phalcon\Http\Request|\Phalcon\HTTP\RequestInterface
 		 */
		public $request;

		/**
 		 * @var \Phalcon\Http\Response|\Phalcon\HTTP\ResponseInterface
 		 */
		public $response;

		/**
 		 * @var \Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface
 		 */
		public $cookies;

		/**
 		 * @var \Phalcon\Filter|\Phalcon\FilterInterface
 		 */
		public $filter;

		/**
 		 * @var \Phalcon\Flash\Direct
 		 */
		public $flash;

		/**
 		 * @var \Phalcon\Flash\Session
 		 */
		public $flashSession;

		/**
 		 * @var \Phalcon\Session\Adapter\Files|\Phalcon\Session\Adapter|\Phalcon\Session\AdapterInterface
 		 */
		public $session;

		/**
 		 * @var \Phalcon\Events\Manager
 		 */
		public $eventsManager;

		/**
 		 * @var \Phalcon\Db
 		 */
		public $db;

		/**
 		 * @var \Phalcon\Security
 		 */
		public $security;

		/**
 		 * @var \Phalcon\Crypt
 		 */
		public $crypt;

		/**
 		 * @var \Phalcon\Tag
 		 */
		public $tag;

		/**
 		 * @var \Phalcon\Escaper|\Phalcon\EscaperInterface
 		 */
		public $escaper;

		/**
 		 * @var \Phalcon\Annotations\Adapter\Memory|\Phalcon\Annotations\Adapter
 		 */
		public $annotations;

		/**
 		 * @var \Phalcon\Mvc\Model\Manager|\Phalcon\Mvc\Model\ManagerInterface
 		 */
		public $modelsManager;

		/**
 		 * @var \Phalcon\Mvc\Model\MetaData\Memory|\Phalcon\Mvc\Model\MetadataInterface
 		 */
		public $modelsMetadata;

		/**
 		 * @var \Phalcon\Mvc\Model\Transaction\Manager
 		 */
		public $transactionManager;

		/**
 		 * @var \Phalcon\Assets\Manager
 		 */
		public $assets;

		/**
		 * @var \Phalcon\DI|\Phalcon\DiInterface
	 	 */
		public $di;

		/**
		 * @var \Phalcon\Session\Bag
	 	 */
		public $persistent;

		/**
 		 * @var \Phalcon\Mvc\View|\Phalcon\Mvc\ViewInterface
 		 */
		public $view;
		
		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @throw \Phalcon\Di\Exception
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getEventsManager(){ }


		/**
		 * Magic method __get
		 *
		 * @param string $propertyName
		 */
		public function __get($property){ }

	}
}
