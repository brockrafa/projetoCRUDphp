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

        $routes['atualizarCliente'] = array (
            "route" => "/atualizarCliente",
            "controller" => "IndexController",
            "action" => "atualizarCliente"
        );

        $routes['removerCliente'] = array (
            "route" => "/removerCliente",
            "controller" => "IndexController",
            "action" => "removerCliente"
        );
        
        
        // Requisições ajax

        $routes['getCustomerData'] = array (
            "route" => "/getCustomerData",
            "controller" => "IndexController",
            "action" => "getCustomerData"
        );


        $this->setRoutes($routes);
    }

    
}

?>