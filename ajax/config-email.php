<?php

require("../functions.php");
require("../config-db.php");

session_start(); 

$emailmaster = $_POST["emailmaster"];

if(isset($emailmaster) && $emailmaster != ""){
    $mydb->query("UPDATE  usuarios SET email = '$emailmaster' WHERE id = '".$_SESSION["id_usuario"]."'");
    
    $_SESSION["email"] = $emailmaster;

    $resposta = array(
        "mensagem" => "Modificação de email realizada com sucesso!",
        "class" => "green"
    );
    
    echo json_encode($resposta);
}

