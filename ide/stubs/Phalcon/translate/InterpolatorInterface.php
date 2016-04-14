<?php

namespace Phalcon\Translate;

/**
 * Phalcon\Translate\AdapterInterface
 * Interface for Phalcon\Translate adapters
 */
interface InterpolatorInterface
{

    /**
     * Replaces placeholders by the values passed
     *
     * @param string $translation 
     * @param mixed $placeholders 
     * @return string 
     */
    public function replacePlaceholders($translation, $placeholders = null);

}
