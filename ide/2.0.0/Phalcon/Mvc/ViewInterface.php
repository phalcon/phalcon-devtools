<?php 

namespace Phalcon\Mvc {

	interface ViewInterface {

		public function setViewsDir($viewsDir);


		public function getViewsDir();


		public function setLayoutsDir($layoutsDir);


		public function getLayoutsDir();


		public function setPartialsDir($partialsDir);


		public function getPartialsDir();


		public function setBasePath($basePath);


		public function setRenderLevel($level);


		public function setMainView($viewPath);


		public function getMainView();


		public function setLayout($layout);


		public function getLayout();


		public function setTemplateBefore($templateBefore);


		public function cleanTemplateBefore();


		public function setTemplateAfter($templateAfter);


		public function cleanTemplateAfter();


		public function setParamToView($key, $value);


		public function setVar($key, $value);


		public function getParamsToView();


		public function getControllerName();


		public function getActionName();


		public function getParams();


		public function start();


		public function registerEngines($engines);


		public function render($controllerName, $actionName, $params=null);


		public function pick($renderView);


		public function partial($partialPath);


		public function finish();


		public function getCache();


		public function cache($options=null);


		public function setContent($content);


		public function getContent();


		public function getActiveRenderPath();


		public function disable();


		public function enable();


		public function reset();

	}
}
