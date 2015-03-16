<?php

namespace Mpwarfw\Component\Request;

use Mpwarfw\Component\Request\Parameters;
use Mpwarfw\Component\Session\Session;

class Request
{
    public $session;
    public $cookies;
    public $get;
    public $post;
    public $server;
    public $files;

    public function __construct( $session ) {

        $this->session = $session;
        $this->cookies = new Parameters( $_COOKIE );
        $this->get     = new Parameters( $_GET );
        $this->post    = new Parameters( $_POST );
        $this->server  = new Parameters( $_SERVER );
        $this->files   = new Parameters( $_FILES );

        $_COOKIE = $_GET = $_POST = $_SERVER = $_FILES = array();

    }
}
