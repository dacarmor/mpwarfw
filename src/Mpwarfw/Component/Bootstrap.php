<?php

namespace Mpwarfw\Component;

class Bootstrap {

    const environment = 'prod';
    const debug = false;

    public function __construct($env, $debug) {
        $this->environment = $env;
        $this->debug = $debug;
        echo "I'm Bootstrap";
    }

    public function execute() {
        $route = new Routing();
        $controllerData = $route->getRoute();
        $controller = new $controllerData;
        $controller->build();
    }

}