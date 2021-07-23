<?php

namespace App\Models;
use MF\Model\Model;

class Cliente extends Model{
    
    private $nome;
    private $cpf;
    private $rg;
    private $telefone;
    private $email;
    private $cidade;
    private $estado;
    private $endereco;

//Métodos mágicos get e set
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }
    

// Fechar conexão com bd
    public function closeConnection(){
        unset($this->db); 
    }

// Obter todos os clientes
    public function getAll(){
        $query="select * from clientes";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

// Inserir novo cliente
    public function salvarNovoCliente(){
        $query="insert into clientes (cpf,nome,rg,telefone,email,cidade,estado,endereco) values (:cpf, :nome, :rg, :telefone, :email, :cidade, :estado, :endereco)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":cpf",$this->__get("cpf"));
        $stmt->bindValue(":nome",$this->__get("nome"));
        $stmt->bindValue(":rg",$this->__get("rg"));
        $stmt->bindValue(":telefone",$this->__get("telefone"));
        $stmt->bindValue(":email",$this->__get("email"));
        $stmt->bindValue(":cidade",$this->__get("cidade"));
        $stmt->bindValue(":estado",$this->__get("estado"));
        $stmt->bindValue(":endereco",$this->__get("endereco"));
        return $stmt->execute();
        
    }

// Atualizar cliente existente
    public function updateCliente(){
        $query="update clientes set nome = :nome,rg = :rg, telefone = :telefone, email = :email, cidade = :cidade, estado = :estado, endereco = :endereco where cpf = :cpf";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":cpf",$this->__get("cpf"));
        $stmt->bindValue(":nome",$this->__get("nome"));
        $stmt->bindValue(":rg",$this->__get("rg"));
        $stmt->bindValue(":telefone",$this->__get("telefone"));
        $stmt->bindValue(":email",$this->__get("email"));
        $stmt->bindValue(":cidade",$this->__get("cidade"));
        $stmt->bindValue(":estado",$this->__get("estado"));
        $stmt->bindValue(":endereco",$this->__get("endereco"));
        return $stmt->execute();
    }

//Remover cliente existente
    public function removerCliente(){

        $query="delete from clientes where cpf = :cpf";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":cpf",$this->__get("cpf"));
        return $stmt->execute();
    }

//Obter dados de um usuario
    public function getCustomerData(){

        $query="select * from clientes where cpf = :cpf";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':cpf',$this->__get("cpf"));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

}


?>