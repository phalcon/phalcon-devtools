<?php

return new \Phalcon\Config(array(

    'database' => array(
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'root',
        'password'   => '',
        'dbname'     => 'test',
        'charset'    => 'utf8',
    ),

    'application' => array(
        'modelsDir'      => APP_PATH . '/models/',
        'viewsDir'       => APP_PATH . '/views/',
        'baseUri'        => '/@@name@@/',
    )
));
