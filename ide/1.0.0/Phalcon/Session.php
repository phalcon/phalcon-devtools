<?php 

namespace Phalcon {

	/**
	 * Phalcon\Session
	 *
	 * Session client-server persistent state data management. This component
	 * allows you to separate your session data between application or modules.
	 * With this, it's possible to use the same index to refer a variable
	 * but it can be in different applications.
	 *
	 *<code>
	 * $session = new Phalcon\Session\Adapter\Files(array(
	 *    'uniqueId' => 'my-private-app'
	 * ));
	 *
	 * $session->start();
	 *
	 * $session->set('var', 'some-value');
	 *
	 * echo $session->get('var');
	 *</code>
	 */
	
	abstract class Session {
	}
}
