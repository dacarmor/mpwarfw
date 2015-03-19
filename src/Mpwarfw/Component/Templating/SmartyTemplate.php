<?php

namespace Mpwarfw\Component\Templating;

use Smarty;

class SmartyTemplate implements Templating
{

    private $smarty;

    public function __construct() {
        
        $this->smarty = new \Smarty();
        $this->smarty->setCompileDir( '../src/Templates/cache' );
    
    }

    public function render( $template, $vars = null ) {
        
        $this->assign( $vars );
        return $this->smarty->display( $template );

    }

    private function assign( $vars ) {

        foreach ($vars as $key => $value) {

            $this->smarty->assign( $key, $value );

        }
    
    }

}
