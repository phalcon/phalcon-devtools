<?php
return new \Phalcon\Config(array(
	'database' => array(
		'host'     => 'localhost',
		'username' => 'root',
		'password' => '',
		'name'     => 'phalcon',
	),
	'phalcon' => array(
		'controllersDir' => '/../app/controllers/',
		'modelsDir'      => '/../app/models/',
		'viewsDir'       => '/../app/views/',
		'pluginsDir'     => '/../app/plugins/',
		'libraryDir'     => '/../app/library/',
		'baseUri'        => '/@@name@@/',
	),
	'metadata' => array(
		'adapter' => 'Apc'
	),
));
