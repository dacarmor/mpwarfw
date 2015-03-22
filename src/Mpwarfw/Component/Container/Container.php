<?php

namespace Mpwarfw\Component\Container;

use Mpwarfw\Component\Routing\Route;
use Mpwarfw\Component\Error\Error;

class Container
{

    const YAML_CONFIG_FILE = '../src/Config/services.yaml';
    private $services;
    private $args = array();
    private static $instance;

    public function __construct() {

        $yaml = new \Symfony\Component\Yaml\Parser();
        $this->services = $yaml->parse( file_get_contents( self::YAML_CONFIG_FILE ) );

    }
    
    public function get( $service ) {

        try {
            if ( !array_key_exists( $service, $this->services ) ) {
                throw new \Exception('<b>Error:</b> El servicio <i>'.$service.'</i> no existe');
            }
        }
        catch ( \Exception $e ) {
            $route = new Error();
            $response = $route->setError( $e->getMessage() );
            $response->send();
            die();
        }

        if ( !isset( self::$instance ) ) {

            if ( !empty( $this->services[$service]['args'] ) ) {
                foreach ( $this->services[$service]['args'] as $args ) {
                    // Iteración 1
                    $this->args[] = new $args;
                    // Iteración 2: recursividad
                }
            }
            $reflection = new \ReflectionClass( $this->services[$service]['class'] );
            return $reflection->newInstanceArgs( $this->args );

        }

    }
        
    public function __clone() {
        
        trigger_error('Clone no se permite.', E_USER_ERROR);
    
    }

}