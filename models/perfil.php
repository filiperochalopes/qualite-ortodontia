<?php

class Perfil {
    public function __construct(
        $id,
        $usuario,
        $nome,
        $funcao, 
        $cpf, 
        $email, 
        $celular, 
        $cep, 
        $rua,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $estado,
        $cro,
        $especialidade
    ){
        $this->id = $id;
        $this->usuario = $usuario;
        $this->nome = $nome;
        $this->funcao = $funcao;    
        $this->cpf = $cpf;
        $this->email = $email;
        $this->celular = $celular;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cro = $cro;
        $this->especialidade = $especialidade;
    }
}

?>