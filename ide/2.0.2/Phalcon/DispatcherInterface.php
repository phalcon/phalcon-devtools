<?php 

namespace Phalcon {

	interface DispatcherInterface {

		public function setActionSuffix($actionSuffix);


		public function setDefaultNamespace($defaultNamespace);


		public function setDefaultAction($actionName);


		public function setNamespaceName($namespaceName);


		public function setModuleName($moduleName);


		public function setActionName($actionName);


		public function getActionName();


		public function setParams($params);


		public function getParams();


		public function setParam($param, $value);


		public function getParam($param, $filters=null);


		public function isFinished();


		public function getReturnedValue();


		public function dispatch();


		public function forward($forward);

	}
}
