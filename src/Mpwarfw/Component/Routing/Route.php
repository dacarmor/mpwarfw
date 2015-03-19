<?php

namespace Mpwarfw\Component\Routing;

final class Route
{
    private $controller;
    private $action;
    private $params;

    public function __construct($controller, $action, $params = array() ) {

        $this->action = $action;
        $this->params = $params;
        $this->controller = $controller;

    }
    
    public function getRouteController() {

        return $this->controller;

    }

    public function getRouteAction() {
        
        return $this->action;
    
    }

    public function getRouteParams() {
        
        return $this->params;
    
    }

}