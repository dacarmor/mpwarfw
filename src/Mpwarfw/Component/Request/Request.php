<?php

namespace Mpwarfw\Component\Request;

use Mpwarfw\Component\Request\Parameters;

class Request
{
    public $get;
    public $post;
    public $server;
    public $cookies;
    public $session;

    public function __construct() {
        $this->get     = new Parameters($_GET);
        $this->post    = new Parameters($_POST);
        $this->server  = new Parameters($_SERVER);
        $this->cookies = new Parameters($_COOKIE);
        $this->session = new Parameters($_SESSION);

        $_GET = $_POST = $_COOKIE = $_SERVER = $_SESSION = array();
    }
}
