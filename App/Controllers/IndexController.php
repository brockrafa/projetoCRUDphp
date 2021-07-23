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

    public function atualizarCliente(){
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

      //Realizar uma junção do endereço para um padrão
      $endereco = $_POST['logradouro'].' - '.$_POST['bairro'].' - '.$_POST['numero'];

      //Setar no atributo do objeto
      $cliente->__set("endereco",$endereco);

      $cliente->updateCliente();

      header("Location: /");

    }
    
    
//------------------- Requisições ajax ----------------

    // Obter dados de determinado cliente
    public function getCustomerData(){

      //Obter instância de cliente
      $cliente = Container::getModel('Cliente');

      //Setar atributo cpf
      $cliente->__set("cpf",$_GET['cpf']);

      //Obter todos dados do cliente com aquele cpf
      $this->view->cliente = $cliente->getCustomerData();

      //Explode do endereço para dividi-lo novamente em 3 partes
      $endereco = explode('-',$this->view->cliente->endereco);
      $this->view->logradouro = $endereco[0];
      $this->view->bairro = $endereco[1];
      $this->view->numero = $endereco[2];

      //Renderizar body do modal para retorno passando o layout 'null', para nao renderizar layout
      $this->render("req/editar_cliente",null);

    }

}
?>