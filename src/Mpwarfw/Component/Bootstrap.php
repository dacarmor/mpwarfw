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

    }

    public function execute( Request $request ) {

        $routing = new Routing( $request );

        $controllerPath = $routing->getControllerPath();
        $controllerName = $controllerPath->getRouteController();
        $controller = new $controllerName;

        $response = call_user_func_array(
            array(
                $controller,
                $controllerPath->getRouteAction()
            ),
            $controllerPath->getRouteParams()
        );
        return $response;
    }

}