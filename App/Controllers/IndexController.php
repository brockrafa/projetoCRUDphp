<?php

namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action{

    public function index(){
      $cliente = Container::getModel("cliente");
      $this->view->clientes = $cliente->getAll();
      $this->render('index','layout');
    }

}
?>