<?php

namespace Mpwarfw\Component\Error;

use Mpwarfw\Component\BaseController\BaseController;
use Mpwarfw\Component\Templating\SmartyTemplate;
use Mpwarfw\Component\Response\HttpResponse;

class Error {

    private $error = array();

    public function __construct() {}

    public function build() {

        $view = new SmartyTemplate();
        $response = new HttpResponse( $view->render( dirname(__FILE__).'/Error.smarty.tpl', $this->error ) );
        return $response;

    }

    public function setError( $error ) {

        $this->error['error'] = $error;
        return $this->build();

    }

}