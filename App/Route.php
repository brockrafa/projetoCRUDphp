<?php 

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap{

    public function initRoutes(){
        
        $routes['home'] = array (
            "route" => "/",
            "controller" => "IndexController",
            "action" => "index"
        );
        
        $routes['cadastrarNovoCliente'] = array (
            "route" => "/cadastrarNovoCliente",
            "controller" => "IndexController",
            "action" => "cadastrarNovoCliente"
        );

        $this->setRoutes($routes);
    }

    
}

?>