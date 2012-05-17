<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

class ControllersController extends ControllerBase {

	public function indexAction(){

	}

	/**
	 * Generate controller
	 */
	public function createAction(){

		if($this->request->isPost()){

			$name = $this->request->getPost('name', 'string');
			$force = $this->request->getPost('force', 'int');

			try {

				$modelBuilder = Phalcon_Builder::factory('Controller', array(
					'name' => $name,
					'directory' => Phalcon_WebTools::getPath(),
					'force' => $force
				));

				$modelBuilder->build();

				Phalcon_Flash::success('The controller "'.$name.'" was created successfully', 'alert alert-success');
			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}

		}

		return $this->_forward('controllers/index');

	}


}