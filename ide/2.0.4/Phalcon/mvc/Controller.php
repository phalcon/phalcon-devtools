<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Controller
 * Every application controller should extend this class that encapsulates all the controller functionality
 * The controllers provide the “flow” between models and views. Controllers are responsible
 * for processing the incoming requests from the web browser, interrogating the models for data,
 * and passing that data on to the views for presentation.
 * <code>
 * <?php
 * class PeopleController extends \Phalcon\Mvc\Controller
 * {
 * //This action will be executed by default
 * public function indexAction()
 * {
 * }
 * public function findAction()
 * {
 * }
 * public function saveAction()
 * {
 * //Forwards flow to the index action
 * return $this->dispatcher->forward(array('controller' => 'people', 'action' => 'index'));
 * }
 * }
 * </code>
 */
<<<<<<< HEAD
abstract class Controller extends \Phalcon\Di\Injectable implements \Phalcon\Mvc\ControllerInterface
=======
abstract class Controller extends \Phalcon\Di\Injectable
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
{

    /**
     * Phalcon\Mvc\Controller constructor
     */
    public final function __construct() {}

}
