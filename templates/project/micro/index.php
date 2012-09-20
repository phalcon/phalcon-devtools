<?php

error_reporting(E_ALL);

try {

	/**
	 * Read the configuration
	 */
	$config = include __DIR__.'/../config/config.php';

	$di = new \Phalcon\DI\FactoryDefault();

	/**
	 * The URL component is used to generate all kind of urls in the application
	 */
	$di->set('url', function() use ($config) {
		$url = new \Phalcon\Mvc\Url();
		$url->setBaseUri($config->application->baseUri);
		return $url;
	});

	/**
	 * Database connection is created based in the parameters defined in the configuration file
	 */
	$di->set('db', function() use ($config) {
		return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
			"host" => $config->database->host,
			"username" => $config->database->username,
			"password" => $config->database->password,
			"dbname" => $config->database->name
		));
	});

	/**
	 * Registering an autoloader
	 */
	$loader = new \Phalcon\Loader();

	$loader->registerDirs(
		array(
			$config->application->modelsDir
		)
	)->register();

	/**
	 * Starting the application
	 */
	$app = new \Phalcon\Mvc\Micro();

	/**
	 * Add your routes here
	 */
	$app->get('/', function () {
		require __DIR__."/../views/index.phtml";
	});

	/**
	 * Not found handler
	 */
	$app->notFound(function () use ($app) {
		$app->response->setStatusCode(404, "Not Found")->sendHeaders();
		require __DIR__."/../views/404.phtml";
	});

	/**
	 * Handle the request
	 */
	$app->handle();

} catch (Phalcon\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}