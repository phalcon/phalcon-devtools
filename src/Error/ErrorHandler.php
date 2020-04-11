<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Error;

use Phalcon\Di\Injectable;
use Phalcon\Logger;

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
                ini_set('display_errors', '1');
                ini_set('display_startup_errors', '1');
                error_reporting(-1);
                break;
            default:
                ini_set('display_errors', '0');
                ini_set('display_startup_errors', '0');
                error_reporting(0);
                break;
        }

        if (PHP_SAPI == 'cli') {
            ini_set('html_errors', '0');
        } else {
            ini_set('html_errors', '1');
        }

        set_error_handler([$this, 'customErrorHandler']);

        $that = $this;
        set_exception_handler(
            /** @var \Exception\Error $e */
            function ($e) use ($that) {
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
     */
    public function handle(AppError $error): void
    {
        $di = $this->getDI();

        $type = $this->mapErrors($error->type());
        $message = "$type: {$error->message()} in {$error->file()} on line {$error->line()}";

        if ($di->has('logger')) {
            /** @var Logger $logger */
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
     * @param int $code
     * @return mixed
     */
    public function mapErrors(int $code)
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
     * @param  int $code
     * @return int
     */
    public function mapErrorsToLogType(int $code): int
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

    public function customErrorHandler($errno, $errstr, $errfile, $errline)
    {
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

        $this->handle(new AppError($options));
    }
}
