<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'root',
        'password'   => '',
        'dbname'     => 'test',
    ),
    'application' => array(
        'modelsDir'      => __DIR__ . '/../models/',
        'viewsDir'      => __DIR__ . '/../views/',
        'baseUri'        => '/@@name@@/',
    )
));
