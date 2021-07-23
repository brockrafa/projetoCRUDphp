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

    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }

    public function closeConnection(){
        unset($this->db); 
    }
}


?>