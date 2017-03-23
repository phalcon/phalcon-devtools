<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\Callback
 *
 * Calls user function for validation
 *
 * <code>
 * use Phalcon\Validation\Validator\Callback as CallbackValidator;
 * use Phalcon\Validation\Validator\Numericality as NumericalityValidator;
 *
 * $validator->add(
 *     ["user", "admin"],
 *     new CallbackValidator(
 *         [
 *             "message" => "There must be only an user or admin set",
 *             "callback" => function($data) {
 *                 if (!empty($data->getUser()) && !empty($data->getAdmin())) {
 *                     return false;
 *                 }
 *
 *                 return true;
 *             }
 *         ]
 *     )
 * );
 *
 * $validator->add(
 *     "amount",
 *     new CallbackValidator(
 *         [
 *             "callback" => function($data) {
 *                 if (!empty($data->getProduct())) {
 *                     return new NumericalityValidator(
 *                         [
 *                             "message" => "Amount must be a number."
 *                         ]
 *                     );
 *                 }
 *             }
 *         ]
 *     )
 * );
 * </code>
 */
class Callback extends \Phalcon\Validation\Validator
{

    /**
     * Executes the validation
     *
     * @param \Phalcon\Validation $validation
     * @param string $field
     * @return bool
     */
    public function validate(\Phalcon\Validation $validation, $field) {}

}
