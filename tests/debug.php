<?php
$config =  include './webtools/app/config/config.php';

print_r($config);

$class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;

$params = [
    'host'     => $config->database->host,
    'username' => $config->database->username,
    'password' => $config->database->password,
    'dbname'   => $config->database->dbname,
    'charset'  => $config->database->charset,
    'port'     => $config->database->port
];

print_r($params);

if ($config->database->adapter == 'Postgresql') {
unset($params['charset']);
}
print_r($params);
print_r($config);
print_r($class);
var_dump(new $class($params));

?>
