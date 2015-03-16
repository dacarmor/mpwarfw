<?php

namespace Mpwarfw\Component\Request;

class Parameters
{
    private $params;

    public function __construct( $params ) {

        $this->params = $params;

    }

    public function getValue( $key ) {

        if ( !empty( $this->params[$key] ) && filter_var( $this->params[$key], FILTER_SANITIZE_STRING ) ) {
            return $this->params[$key];
        }
        return false;

    }
}