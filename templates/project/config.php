<?php
return new \Phalcon\Config(array(
	'database' => array(
		'host'     => 'localhost',
		'username' => 'root',
		'password' => '',
		'name'     => 'phalcon',
	),
	'phalcon' => array(
		'controllersDir' => __DIR__ . '/../../app/controllers/',
		'modelsDir'      => __DIR__ . '/../../app/models/',
		'viewsDir'       => __DIR__ . '/../../app/views/',
		'pluginsDir'     => __DIR__ . '/../../app/plugins/',
		'libraryDir'     => __DIR__ . '/../../app/library/',
		'baseUri'        => '/@@name@@/',
	),
	'metadata' => array(
		'adapter' => 'Apc'
	),
));
