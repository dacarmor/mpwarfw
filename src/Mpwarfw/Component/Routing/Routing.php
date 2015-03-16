<?php

namespace Mpwarfw\Component\Routing;

use Mpwarfw\Component\Request\Request;

class Routing
{
    
    private $request;

    public function __construct( Request $request ) {
    
        $this->request = $request;
    
    }
    
    public function getRoute() {

        $uri = $this->request->server->getValue( 'REQUEST_URI' );
        if ( $this->routeExists( $uri ) ) {
            return $this->routeExists( $uri );
        }
        return false;
    
    }

    private function routeExists( $uri ) {

        $uri = explode( '/?', $uri );
        $uri = trim( $uri[0], '/' );
        $yaml = new \Symfony\Component\Yaml\Parser();
        $routes = $yaml->parse( file_get_contents( '../src/Config/routes.yaml' ) );
        
        if ( $uri == '' ) return "Controllers\Home\Home";
        foreach ( $routes as $key => $route ) {
            if ( $key == $uri ) return $route['path'];
        }
        return false;

    }

}