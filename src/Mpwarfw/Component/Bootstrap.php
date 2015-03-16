<?php

namespace Mpwarfw\Component;

use Mpwarfw\Component\Routing\Routing;
use Mpwarfw\Component\Request\Request;

class Bootstrap
{

    private $environment;
    private $debug;

    public function __construct( $env = 'prod', $debug = false ) {

        $this->debug       = $debug;
        $this->environment = $env;
        echo "Bootstrap";

    }

    public function execute( Request $request ) {

        $route = new Routing( $request );
        $controllerData = $route->getRoute();
        if ( $controllerData ) {
            $controller = new $controllerData;
            $controller->build();
        }
        else {
            echo "<h1>Error 404</h1>";
        }
    }

}