<?php

require("../functions.php");
require("../config-db.php");
require("../config-globals.php");

session_start();

$nome = $_POST["nome"];

if(isset($nome)){

    if(checkConvenio($nome)){
        $resposta = array(
            "mensagem" => "Convênio já cadastrado!",
            "class" => "red"
        );
        
        echo json_encode($resposta);

    }else{

        $sql = "INSERT INTO `convenios` (
            `id`, 
            `convenio`
        ) VALUES (
            NULL,  
            '$nome' );";

        $mydb->query($sql);

        $resposta = array(
            "mensagem" => "Novo convênio cadastrado!",
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