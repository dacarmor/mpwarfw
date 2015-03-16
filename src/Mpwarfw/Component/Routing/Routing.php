<?php

namespace Mpwarfw\Component\Routing;

use Mpwarfw\Component\Request\Request;

class Routing
{
    
    private $url;
    private $request;

    public function __construct(Request $request) {
    
        $this->request = $request;
    
    }
    
    public function getRoute() {

        if (!$this->routeExists($this->url)) {
            return false;
        }
        return $this->routeExists($this->url);
    
    }

    private function routeExists($url) {

        $url = explode('/?', $url);
        $url = trim($url[0], '/');
        $yaml = new \Symfony\Component\Yaml\Parser();
        $routes = $yaml->parse(file_get_contents('../src/Config/routes.yaml'));
        
        if ($url == '') return "Controllers\Home\Home";
        foreach ($routes as $key => $route) {
            if ($key == $url) return $route['path'];
        }
        return false;

    }

}