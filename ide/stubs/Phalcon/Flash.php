<?php

namespace Phalcon;

/**
 * Phalcon\Flash
 * Shows HTML notifications related to different circumstances. Classes can be stylized using CSS
 * <code>
 * $flash->success("The record was successfully deleted");
 * $flash->error("Cannot open the file");
 * </code>
 */
abstract class Flash implements \Phalcon\Di\InjectionAwareInterface
{

    protected $_cssClasses;


    protected $_implicitFlush = true;


    protected $_automaticHtml = true;


    protected $_escaperService = null;


    protected $_autoescape = true;


    protected $_dependencyInjector = null;


    protected $_messages;


    /**
     * Phalcon\Flash constructor
     *
     * @param mixed $cssClasses 
     */
    public function __construct($cssClasses = null) {}

    /**
     * Returns the autoescape mode in generated html
     *
     * @return bool 
     */
    public function getAutoescape() {}

    /**
     * Set the autoescape mode in generated html
     *
     * @param bool $autoescape 
     * @return Flash 
     */
    public function setAutoescape($autoescape) {}

    /**
     * Returns the Escaper Service
     *
     * @return EscaperInterface 
     */
    public function getEscaperService() {}

    /**
     * Sets the Escaper Service
     *
     * @param mixed $escaperService 
     * @return Flash 
     */
    public function setEscaperService(EscaperInterface $escaperService) {}

    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector 
     * @return Flash 
     */
    public function setDI(DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return DiInterface 
     */
    public function getDI() {}

    /**
     * Set whether the output must be implicitly flushed to the output or returned as string
     *
     * @param bool $implicitFlush 
     * @return \Phalcon\FlashInterface 
     */
    public function setImplicitFlush($implicitFlush) {}

    /**
     * Set if the output must be implicitly formatted with HTML
     *
     * @param bool $automaticHtml 
     * @return \Phalcon\FlashInterface 
     */
    public function setAutomaticHtml($automaticHtml) {}

    /**
     * Set an array with CSS classes to format the messages
     *
     * @param array $cssClasses 
     * @return \Phalcon\FlashInterface 
     */
    public function setCssClasses(array $cssClasses) {}

    /**
     * Shows a HTML error message
     * <code>
     * $flash->error('This is an error');
     * </code>
     *
     * @param mixed $message 
     * @return string 
     */
    public function error($message) {}

    /**
     * Shows a HTML notice/information message
     * <code>
     * $flash->notice('This is an information');
     * </code>
     *
     * @param mixed $message 
     * @return string 
     */
    public function notice($message) {}

    /**
     * Shows a HTML success message
     * <code>
     * $flash->success('The process was finished successfully');
     * </code>
     *
     * @param mixed $message 
     * @return string 
     */
    public function success($message) {}

    /**
     * Shows a HTML warning message
     * <code>
     * $flash->warning('Hey, this is important');
     * </code>
     *
     * @param mixed $message 
     * @return string 
     */
    public function warning($message) {}

    /**
     * Outputs a message formatting it with HTML
     * <code>
     * $flash->outputMessage('error', message);
     * </code>
     *
     * @param string $type 
     * @param string|array $message 
     * @return string|void 
     */
    public function outputMessage($type, $message) {}

    /**
     * Clears accumulated messages when implicit flush is disabled
     */
    public function clear() {}

}
