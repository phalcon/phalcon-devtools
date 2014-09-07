<?php 

namespace Phalcon\Session\Adapter {

    /**
     * Phalcon\Session\Adapter\Files
     *
     * This adapter store sessions in plain files
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
    class Files extends \Phalcon\Session\Adapter implements \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \Phalcon\Session\AdapterInterface
    {
    }
}
