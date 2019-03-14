<?php

require("../functions.php");
require("../config-db.php");
require("../config-globals.php");

session_start();

// echo $_SERVER['REQUEST_METHOD'];

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
// $nome = filter_input(INPUT_POST, 'nome');
$email = $_POST["email"];
$celular = $_POST["celular"];

$senha = $_POST["senha"];
$senha_md5 = md5($senha);

$cep = $_POST["cep"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$complemento = $_POST["complemento"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];

$cro = $_POST["cro"];
$especialidade = $_POST["especialidade"];

$permissoes = array(
    "configuracoes" => true,
    "validacao-cadastro" => false,
    "iniciar-atendimento" => true,
    "meus-atendimentos" => true
);

$permissoes = json_encode($permissoes);

if(isset($nome)){

    if(checkEmail($email)){
        $resposta = array(
            "mensagem" => "Email já cadastrado!",
            "class" => "red"
        );
        
        echo json_encode($resposta);

    }else{

        $sql = "INSERT INTO `usuarios` (
            `id`, 
            `senha`, 
            `email`, 
            `permissoes`
        ) VALUES (
            NULL,  
            '$senha_md5', 
            '$email', 
            '$permissoes');";

        $mydb->query($sql);

        // echo $sql;
        $usuario = $mydb->insert_id;
        // echo $id;

        $sql2 = "INSERT INTO `perfis` (
                `id`, 
                `usuario`, 
                `nome`,
                `funcao`, 
                `cpf`, 
                `email`, 
                `celular`, 
                `cep`,
                `rua`, 
                `numero`,
                `complemento`,
                `bairro`,  
                `cidade`,
                `estado`, 
                `cro`,                
                `especialidade`
            ) VALUES (
                NULL, 
                '$usuario',
                '$nome',
                'dentista',
                '$cpf',
                '$email',
                '$celular',
                '$cep',
                '$rua',
                '$numero',
                '$complemento',
                '$bairro',
                '$cidade',
                '$estado',
                '$cro',
                '$especialidade'
                );";
        
        $query2 = $mydb->query($sql2);
        
        if($query2){

        enviaremail($email, "Cadastro pontos fidelidade", "Você foi cadastrado com sucesso no site Qualité Ortodontia, favor esperar a aprovação de seu perfil pelo admnistrador");
        
        // Encaminhar para página de aguarde.
        $resposta = array(
            "mensagem" => "Obrigado. Você foi cadastrado com sucesso!",
            "class" => "green",
            "link" => $domain."aguarde"
        );
        
        echo json_encode($resposta);

        }else{
            $resposta = array(
                "mensagem" => "Ocorreu um erro. Por favor tente novamente",
                "class" => "red",
            );
            
            echo json_encode($resposta);
        }

    }
    
}else{
    $resposta = array(
        "mensagem" => "Ocorreu um erro de preenchimento. Por favor tente novamente",
        "class" => "red",
    );
    
    echo json_encode($resposta);
}