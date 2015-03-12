<?php

namespace Mpwarfw\Component;

class Routing {
    
    public function getRoute() {
        
        echo "<h1>".$_SERVER['REQUEST_URI']."</h1>";
        
        $yaml = new \Symfony\Component\Yaml\Parser();
        $value = $yaml->parse(file_get_contents('../src/config.yaml'));
        var_dump($value);

        return "Controllers\\Home\\Home";
    }

}