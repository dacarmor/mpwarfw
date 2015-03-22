<?php

namespace Mpwarfw\Component\BaseController;

use Mpwarfw\Component\Container\Container;

abstract class BaseController
{

    public $container;

    public function __construct() {
    
        $this->container = new Container();
    
    }
        
}