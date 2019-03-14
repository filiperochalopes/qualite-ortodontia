<?php

require("../functions.php");
require_once("../config-db.php");
require("../config-globals.php");

session_start();

$numero = $_POST["numero"];
$convenio = $_POST["convenio"];
$paciente = $_POST["paciente"];
$dentista = $_POST["dentista_id"];
$atendimento = $_POST["atendimento"];
$valor = $_POST["valor"];
$descricao = $_POST["descricao"];

if(isset($numero)){

    if(checkGuia($numero)){
        $resposta = array(
            "mensagem" => "Guia já cadastrada!",
            "class" => "red"
        );
        
        echo json_encode($resposta);

    }else{

        $sql = "INSERT INTO `guias` (
            `numero`, 
            `convenio`, 
            `paciente`, 
            `dentista`,
            `atendimento`,
            `valor`,
            `descricao`
        ) VALUES (
            '$numero', 
            '$convenio', 
            '$paciente',
            '$dentista',
            '$atendimento',
            '$valor',
            '$descricao'
            );";

        $mydb->query($sql);
        
        if(!checkPaciente($paciente)){
            $sql2 = "INSERT INTO `pacientes` ( nome ) VALUES ( '$paciente' );";

            $mydb->query($sql2);
        }        

        $resposta = array(
            "mensagem" => "Guia cadastrada, pode iniciar o atendimento!",
            "class" => "green"
        );
        
        echo json_encode($resposta);

    }
    
}else{
    $resposta = array(
        "mensagem" => "Ocorreu um erro de preenchimento. Por favor tente novamente",
        "class" => "red",
    );
    
    echo json_encode($resposta);
}