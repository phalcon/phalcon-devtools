<?php

namespace Phalcon\Session\Adapter;

/**
 * Phalcon\Session\Adapter\Files
 *
 * This adapter store sessions in plain files
 *
 * <code>
 * use Phalcon\Session\Adapter\Files;
 *
 * $session = new Files(
 *     [
 *         "uniqueId" => "my-private-app",
 *     ]
 * );
 *
 * $session->start();
 *
 * $session->set("var", "some-value");
 *
 * echo $session->get("var");
 * </code>
 */
class Files extends \Phalcon\Session\Adapter
{

}
