<?php

return new \Phalcon\Config([
    'database' => [
      'adapter'     => 'Mysql',
      'host'        => 'localhost',
      'username'    => 'root',
      'password'    => '',
      'dbname'      => '@@name@@',
      'charset'     => 'utf8',
    ],
    'version' => '1.0',

    /**
     * if true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    'printNewLine' => true
]);
