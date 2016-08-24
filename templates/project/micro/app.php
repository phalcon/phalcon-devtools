<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

/**
 * Not found handler
 */
$app->notFound(function () {
    $this->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $this['view']->render('404');
});
