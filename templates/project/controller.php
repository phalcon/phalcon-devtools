<?php

class ControllerBase extends \Phalcon\Mvc\Controller
{

	protected function initialize()
	{
		\Phalcon\Tag::prependTitle('@@name@@ | ');
	}

}