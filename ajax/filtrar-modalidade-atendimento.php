<?php

require("../functions.php");
require("../config-db.php");
require("../config-globals.php");

session_start();

$val = $_GET["val"];

if(isset($val)){

    // Verifica condicionais de atendimento
    $especialidade = get_info_perfil($val, "especialidade");
    if(!$especialidade || $especialidade == "CLINICO GERAL"){
        // Não permite atendimento especialista
        $pesquisaatendimentos = $mydb->query("SELECT * FROM atendimentos WHERE id != 2");        
    }else{
        // libera todos
        $pesquisaatendimentos = $mydb->query("SELECT * FROM atendimentos"); 
    }

    $modalidades = $pesquisaatendimentos->fetch_all();

    $resposta = array(
        "modalidades" => $modalidades,
        "mensagem" => "Selecione um modalidade de atendimento $especialidade",
        "class" => "green"
    );
    
    echo json_encode($resposta);
    
}else{
    $resposta = array(
        "mensagem" => "Ocorreu um erro de preenchimento. Por favor tente novamente",
        "class" => "red",
    );
    
    echo json_encode($resposta);
}