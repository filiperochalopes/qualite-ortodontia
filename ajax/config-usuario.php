<?php

require("../functions.php");
require("../config-db.php");

session_start(); 

$usuario = $_POST["emailmaster"];

if(isset($usuario) && $usuario != ""){
    $mydb->query("UPDATE  usuarios SET  usuario = '$usuario' WHERE  email = '".$_SESSION["email"]."'");
    
    $_SESSION["usuario"] = $usuario;

    $resposta = array(
        "mensagem" => "Modificação de usuário realizada com sucesso!",
        "class" => "green"
    );
    
    echo json_encode($resposta);
    
}

