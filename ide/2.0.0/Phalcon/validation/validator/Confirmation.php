<?php

namespace Phalcon\Validation\Validator;

class Confirmation extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface
{

    /**
     * Executes the validation
     *
     * @param \Phalcon\Validation $validation 
     * @param string $field 
     * @return boolean 
     */
	public function validate(\Phalcon\Validation $validation, $field) {}

    /**
     * Compare strings
     *
     * @param string $a 
     * @param string $b 
     * @return boolean 
     */
	protected function compare($a, $b) {}

}
