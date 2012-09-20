<?php

return new \Phalcon\Config(array(
	'database' => array(
		'adapter'  => 'Mysql',
		'host'     => 'localhost',
		'username' => 'root',
		'password' => '',
		'name'     => 'test',
	),
	'application' => array(
		'modelsDir'      => __DIR__ . '/../models/',
		'baseUri'        => '/@@name@@/',
	),
	'models' => array(
		'metadata' => array(
			'adapter' => 'Memory'
		)
	)
));

