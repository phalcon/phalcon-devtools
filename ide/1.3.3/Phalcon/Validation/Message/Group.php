<?php 

namespace Phalcon\Validation\Message {

    /**
     * Phalcon\Validation\Message\Group
     *
     * Represents a group of validation messages
     */
    class Group implements \Countable, \ArrayAccess, \Iterator, \Traversable
    {

        protected $_position;

        protected $_messages;

        /**
         * \Phalcon\Validation\Message\Group constructor
         *
         * @param array $messages
         */
        public function __construct($messages=null)
        {
        }


        /**
         * Gets an attribute a message using the array syntax
         *
         *<code>
         * print_r($messages[0]);
         *</code>
         *
         * @param string $index
         * @return \Phalcon\Validation\Message
         */
        public function offsetGet($index)
        {
        }


        /**
         * Sets an attribute using the array-syntax
         *
         *<code>
         * $messages[0] = new \Phalcon\Validation\Message('This is a message');
         *</code>
         *
         * @param string $index
         * @param \Phalcon\Validation\Message $message
         */
        public function offsetSet($index, $message)
        {
        }


        /**
         * Checks if an index exists
         *
         *<code>
         * var_dump(isset($message['database']));
         *</code>
         *
         * @param string $index
         * @return boolean
         */
        public function offsetExists($index)
        {
        }


        /**
         * Removes a message from the list
         *
         *<code>
         * unset($message['database']);
         *</code>
         *
         * @param string $index
         */
        public function offsetUnset($index)
        {
        }


        /**
         * Appends a message to the group
         *
         *<code>
         * $messages->appendMessage(new \Phalcon\Validation\Message('This is a message'));
         *</code>
         *
         * @param \Phalcon\Validation\Message $message
         */
        public function appendMessage($message)
        {
        }


        /**
         * Appends an array of messages to the group
         *
         *<code>
         * $messages->appendMessages($messagesArray);
         *</code>
         *
         * @param \Phalcon\Validation\MessageInterface[] $messages
         */
        public function appendMessages($messages)
        {
        }


        /**
         * Filters the message group by field name
         *
         * @param string $fieldName
         * @return array
         */
        public function filter($fieldName)
        {
        }


        /**
         * Returns the number of messages in the list
         *
         * @return int
         */
        public function count()
        {
        }


        /**
         * Rewinds the internal iterator
         */
        public function rewind()
        {
        }


        /**
         * Returns the current message in the iterator
         *
         * @return \Phalcon\Validation\Message
         */
        public function current()
        {
        }


        /**
         * Returns the current position/key in the iterator
         *
         * @return int
         */
        public function key()
        {
        }


        /**
         * Moves the internal iteration pointer to the next position
         *
         */
        public function next()
        {
        }


        /**
         * Check if the current message in the iterator is valid
         *
         * @return boolean
         */
        public function valid()
        {
        }


        /**
         * Magic __set_state helps to re-build messages variable when exporting
         *
         * @param array $group
         * @return \Phalcon\Mvc\Model\Message\Group
         */
        public static function __set_state($group)
        {
        }

    }
}
