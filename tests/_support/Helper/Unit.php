<?php
namespace Helper;

use Codeception\Util\Autoload;

AutoLoad::addNamespace('Phalcon', '/src');

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Unit extends \Codeception\Module
{

}
