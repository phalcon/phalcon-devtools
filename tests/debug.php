<?php
$config =  include '../webtools/app/config/config.php';

$class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;

$params = [
'host'     => $config->database->host,
'username' => $config->database->username,
'password' => $config->database->password,
'dbname'   => $config->database->dbname,
'charset'  => $config->database->charset
];

if ($config->database->adapter == 'Postgresql') {
unset($params['charset']);
}
var_dump($params);
var_dump($config);
var_dump($class);
var_dump(new $class($params));

?>
