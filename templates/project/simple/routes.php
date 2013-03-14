<?php

$router = new Phalcon\Mvc\Router(false);

$router->add('/', array(
	'controller' => 'index',
	'action' => 'index'
));

return $router;