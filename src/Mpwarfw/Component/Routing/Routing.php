<?php

namespace Mpwarfw\Component\Routing;

use Mpwarfw\Component\Request\Request;

final class Routing
{
    const YAML_CONFIG_FILE = '../src/Config/routes.yaml';

    private $routes;
    private $request;

    public function __construct( Request $request ) {
    
        $this->request = $request;
        $yaml = new \Symfony\Component\Yaml\Parser();
        $this->routes = $yaml->parse( file_get_contents( self::YAML_CONFIG_FILE ) );

    }
    
    public function getControllerPath() {

        $uri = $this->request->server->getValue( 'REQUEST_URI' );
        $uri_params = explode( '/', $uri );

        $controller = $uri_params[1];
        $params     = array_slice($uri_params, 2);
        $params     = array_filter($params);
        
        try {
            if ( $controller != null ) {
                foreach ( $this->routes as $key => $route ) {
                    if ( $key == $controller ) {
                        return new Route( $route['path'], $route['action'], $params );
                    }
                }
                throw new \Exception( "El controller <i>".$controller."</i> no existe." );
            }
            return new Route( $this->routes['home']['path'], $this->routes['home']['action'], $params );
        }
        catch ( \Exception $e ) {

            return new Route( 'Mpwarfw\\Component\\Error\\Error', 'setError', array( 'error' => $e->getMessage() ) );

        }

    }

}