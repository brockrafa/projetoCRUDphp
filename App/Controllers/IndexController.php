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
    
    public function cadastrarNovoCliente(){

      //Nova instancia do objeto Cliente
      $cliente = Container::getModel("cliente");

      //Setar valores nos atributos do objeto
      $cliente->__set("nome",$_POST['nome']);
      $cliente->__set("cpf",$_POST['cpf']);
      $cliente->__set("rg",$_POST['rg']);
      $cliente->__set("telefone",$_POST['telefone']);
      $cliente->__set("email",$_POST['email']);
      $cliente->__set("cidade",$_POST['cidade']);
      $cliente->__set("estado",$_POST['estado']);

      //Realizar uma junção do endereço em um padrão
      $endereco = $_POST['logradouro'].' - '.$_POST['bairro'].' - '.$_POST['numero'];

      //Setar no atributo do objeto
      $cliente->__set("endereco",$endereco);
      
      //Salvar no banco de dados novo cliente e redirecionar a tela principal
      if($cliente->salvarNovoCliente()){
        header("location:/?status=1");
      }else{
        header("location:/?status=0");
      }

    }

}
?>