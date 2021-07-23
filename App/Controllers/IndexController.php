<?php

namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action{

    public function index(){

      //Criação de um objeto cliente
      $cliente = Container::getModel("cliente");

      //Chamada da função que retorna todos os clientes cadastrados
      $this->view->clientes = $cliente->getAll();

      //Renderiza a página index
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
      try{
        if($cliente->salvarNovoCliente()){
          header("location:/?status=1");
        }else{
          header("location:/?status=0");
        }
      }catch(\PDOException $e){
        echo "Erro ao inserir no banco de dados! Codigo de apoio: 8000";
      }

    }

    public function atualizarCliente(){

      //Nova instância do objeto Cliente
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

      //Chama a função responsavel por persistir os dados no banco
      $cliente->updateCliente();

      //Redireciona para a rota principal
      header("Location: /");

    }

    public function removerCliente(){

      //Nova instancia do objeto Cliente
      $cliente = Container::getModel("cliente");

      //Setar valores nos atributos do objeto
      $cliente->__set("cpf",$_POST['cpf']);

      //Chama a função responsavel por deletar o cliente e retorna o status da operação. 1 se foi feita a exclusão ou 0 se occoreu algum erro.
      echo $cliente->removerCliente();
    }
    
    
//------------------- Requisições ajax ----------------

    // Obter dados de determinado cliente de acordo com o cpf
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

    public function verificarCpf(){

      //Obter instância de cliente
      $cliente = Container::getModel('Cliente');

      //Setar atributo cpf
      $cliente->__set("cpf",$_GET['cpf']);

      //Consultar existencia de cpf
      echo $cliente->consultarCpf();
    }

}
?>