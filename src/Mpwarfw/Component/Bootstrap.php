<?php

namespace Mpwarfw\Component;

class Bootstrap {

    private $environment;
    private $debug;

    public function __construct($env = 'prod', $debug = false) {
        $this->environment = $env;
        $this->debug = $debug;
        echo "I'm Bootstrap<br>";
    }

    public function execute() {
        $route = new Routing();
        $controllerData = $route->getRoute();
        if ($controllerData) {
            $controller = new $controllerData;
            $controller->build();
        }
        else {
            echo "<h1>Error 404</h1>";
        }
    }

}