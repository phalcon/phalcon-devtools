<?php

class ControllerBase extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		\Phalcon\Tag::prependTitle('@@name@@ | ');
	}

	protected function forward($uri){
		$uriParts = explode('/', $uri);
		return $this->dispatcher->forward(
			array(
				'controller' => $uriParts[0],
				'action' => $uriParts[1]
			)
		);
	}
}