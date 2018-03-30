<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Nikita Vershinin <endeveit@gmail.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Error;

use Phalcon\Logger;
use Phalcon\Di\Injectable;

/**
 * \Phalcon\Error\ErrorHandler
 *
 * @package Phalcon\Error
 */
class ErrorHandler extends Injectable
{
    /**
     * Registers itself as error and exception handler.
     */
    public function register()
    {
        switch (APPLICATION_ENV) {
            case ENV_TESTING:
            case ENV_DEVELOPMENT:
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(-1);
                break;
            default:
                ini_set('display_errors', 0);
                ini_set('display_startup_errors', 0);
                error_reporting(0);
                break;
        }

        if (PHP_SAPI == 'cli') {
            ini_set('html_errors', 0);
        } else {
            ini_set('html_errors', 1);
        }

        $that = $this;

        set_error_handler(
            function ($errno, $errstr, $errfile, $errline) use ($that) {
                if (!($errno & error_reporting())) {
                    return;
                }

                $options = [
                    'type'    => $errno,
                    'message' => $errstr,
                    'file'    => $errfile,
                    'line'    => $errline,
                    'isError' => true,
                ];

                $that->handle(new AppError($options));
            }
        );

        set_exception_handler(
            function ($e) use ($that) {
                /** @var \Exception|\Error $e */
                $options = [
                    'type'        => $e->getCode(),
                    'message'     => $e->getMessage(),
                    'file'        => $e->getFile(),
                    'line'        => $e->getLine(),
                    'isException' => true,
                    'exception'   => $e,
                ];

                $that->handle(new AppError($options));
            }
        );

        register_shutdown_function(
            function () use ($that) {
                if (!is_null($options = error_get_last())) {
                    $that->handle(new AppError($options));
                }
            }
        );
    }

    /**
     * @param AppError $error
     *
     */
    public function handle(AppError $error)
    {
        $di = $this->getDI();

        $type = $this->mapErrors($error->type());
        $message = "$type: {$error->message()} in {$error->file()} on line {$error->line()}";

        if ($di->has('logger')) {
            $logger = $this->getDI()->getShared('logger');

            $logger->log($this->mapErrorsToLogType($error->type()), $message);
        }

        switch ($error->type()) {
            case E_WARNING:
            case E_NOTICE:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
            case E_USER_NOTICE:
            case E_STRICT:
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
            case E_ALL:
                break;
            default:
                if ($di->has('view')) {
                    // @todo
                } else {
                    echo $message;
                }
        }
    }

    /**
     * Maps error code to a string.
     *
     * @param  integer $code
     * @return mixed
     */
    public function mapErrors($code)
    {
        switch ($code) {
            case 0:
                return 'Uncaught exception';
            case E_ERROR:
                return 'E_ERROR';
            case E_WARNING:
                return 'E_WARNING';
            case E_PARSE:
                return 'E_PARSE';
            case E_NOTICE:
                return 'E_NOTICE';
            case E_CORE_ERROR:
                return 'E_CORE_ERROR';
            case E_CORE_WARNING:
                return 'E_CORE_WARNING';
            case E_COMPILE_ERROR:
                return 'E_COMPILE_ERROR';
            case E_COMPILE_WARNING:
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR:
                return 'E_USER_ERROR';
            case E_USER_WARNING:
                return 'E_USER_WARNING';
            case E_USER_NOTICE:
                return 'E_USER_NOTICE';
            case E_STRICT:
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR:
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED:
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED:
                return 'E_USER_DEPRECATED';
        }

        return $code;
    }

    /**
     * Maps error code to a log type.
     *
     * @param  integer $code
     * @return integer
     */
    public function mapErrorsToLogType($code)
    {
        switch ($code) {
            case E_ERROR:
            case E_RECOVERABLE_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
            case E_PARSE:
                return Logger::ERROR;
            case E_WARNING:
            case E_USER_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
                return Logger::WARNING;
            case E_NOTICE:
            case E_USER_NOTICE:
                return Logger::NOTICE;
            case E_STRICT:
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                return Logger::INFO;
        }

        return Logger::ERROR;
    }
}
